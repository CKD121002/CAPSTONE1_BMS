<?php
session_start();
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $account_type   = mysqli_real_escape_string($conn, $_POST['account_type']);
    $department     = isset($_POST['department']) ? strtoupper(mysqli_real_escape_string($conn, $_POST['department'])) : "";
    $name           = mysqli_real_escape_string($conn, $_POST['name']);
    $username       = mysqli_real_escape_string($conn, $_POST['username']);
    $email          = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $password       = mysqli_real_escape_string($conn, $_POST['password']);
    $id_number      = mysqli_real_escape_string($conn, $_POST['id_number']);

    $upload_dir = "../uploads/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (!isset($_FILES['proof']) || $_FILES['proof']['error'] != 0) {
        die("Error uploading file.");
    }

    $file_name = $_FILES['proof']['name'];
    $file_tmp  = $_FILES['proof']['tmp_name'];
    $file_size = $_FILES['proof']['size'];
    $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed = array("jpg", "jpeg", "png", "pdf");

    if (!in_array($file_ext, $allowed)) {
        die("Invalid file type. Only JPG, JPEG, PNG, and PDF are allowed.");
    }

    if ($file_size > 5 * 1024 * 1024) {
        die("File is too large. Maximum size is 5MB.");
    }

    $new_file_name = time() . "_" . uniqid() . "." . $file_ext;
    $file_path = $upload_dir . $new_file_name;

    if (!move_uploaded_file($file_tmp, $file_path)) {
        die("Failed to upload file.");
    }

    if ($account_type == "resident") {

        $check = "SELECT * FROM residents WHERE username='$username' OR email='$email'";
        $result = mysqli_query($conn, $check);

        if (mysqli_num_rows($result) > 0) {
            header("Location: /BMS/CODES/register.php?error=exists");
            exit();
        }

        $sql = "INSERT INTO residents (name, username, email, contact_number, password, proof_file, id_number, status)
                VALUES ('$name', '$username', '$email', '$contact_number', '$password', '$new_file_name', '$id_number', 'pending')";

        if (mysqli_query($conn, $sql)) {
            header("Location: /BMS/CODES/login.php?register=pending");
            exit();
        } else {
            echo "Resident registration failed: " . mysqli_error($conn);
        }

    } elseif ($account_type == "official") {

        $valid_departments = array("ADMIN", "BPSO", "CLEARANCE", "LUPON");

        if (!in_array($department, $valid_departments)) {
            die("Invalid department selected.");
        }

        $check = "SELECT * FROM officials WHERE username='$username' OR email='$email'";
        $result = mysqli_query($conn, $check);

        if (mysqli_num_rows($result) > 0) {
            header("Location: /BMS/CODES/register.php?error=exists");
            exit();
        }

        $sql = "INSERT INTO officials (name, username, email, contact_number, password, department, proof_file, id_number, status)
                VALUES ('$name', '$username', '$email', '$contact_number', '$password', '$department', '$new_file_name', '$id_number', 'pending')";

        if (mysqli_query($conn, $sql)) {
            header("Location: /BMS/CODES/login.php?register=pending");
            exit();
        } else {
            echo "Official registration failed: " . mysqli_error($conn);
        }

    } else {
        echo "Invalid account type.";
    }

} else {
    echo "Invalid request.";
}
?>