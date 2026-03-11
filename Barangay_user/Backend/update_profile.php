<?php
session_start();
include "../Backend/db_connect.php";

// Make sure the user is logged in
if (!isset($_SESSION['resident_id'])) {
    header("Location: ../Frontend/login.php");
    exit;
}

$resident_id = $_SESSION['resident_id'];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect form data safely
    $full_name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Handle profile picture upload
    $profile_pic = null;
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
        $allowed_ext = ['jpg','jpeg','png','gif'];
        $file_name = $_FILES['profile_pic']['name'];
        $file_tmp = $_FILES['profile_pic']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        if (in_array($file_ext, $allowed_ext)) {
            $new_name = "profile_" . $resident_id . "." . $file_ext;
            $upload_dir = "../uploads/";
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
            $destination = $upload_dir . $new_name;
            
            if (move_uploaded_file($file_tmp, $destination)) {
                $profile_pic = $new_name;
            }
        }
    }

    // Update password if provided
    $password_sql = "";
    if (!empty($_POST['new_password'])) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $password_sql = ", password='$new_password'";
    }

    // Update database
    $profile_pic_sql = $profile_pic ? ", profile_pic='$profile_pic'" : "";

    $sql = "UPDATE residents SET
                full_name='$name',
                username='$username',
                birthdate='$birthdate',
                email='$email',
                contact_number='$contact_number',
                address='$address'
                $profile_pic_sql
                $password_sql
            WHERE resident_id=$resident_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../Frontend/Profile.php?update=success");
    } else {
        header("Location: ../Frontend/Editprofile.php?update=failed");
    }
} else {
    header("Location: ../Frontend/Editprofile.php");
    exit;
}
?>