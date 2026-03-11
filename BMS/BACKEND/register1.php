<?php
session_start();
include "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /BMS/CODES/register.php?error=invalid_request");
    exit();
}

$account_type   = trim($_POST['account_type'] ?? '');
$department     = strtoupper(trim($_POST['department'] ?? ''));
$name           = trim($_POST['name'] ?? '');
$username       = trim($_POST['username'] ?? '');
$email          = trim($_POST['email'] ?? '');
$contact_number = trim($_POST['contact_number'] ?? '');
$password       = trim($_POST['password'] ?? '');
$id_number      = trim($_POST['id_number'] ?? '');

if (
    empty($account_type) ||
    empty($name) ||
    empty($username) ||
    empty($email) ||
    empty($contact_number) ||
    empty($password) ||
    empty($id_number)
) {
    header("Location: /BMS/CODES/register.php?error=empty_fields");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: /BMS/CODES/register.php?error=invalid_email");
    exit();
}

if ($account_type === "official" && empty($department)) {
    header("Location: /BMS/CODES/register.php?error=no_department");
    exit();
}

/* ---------- FILE UPLOAD ---------- */
$upload_dir = "../uploads/";

if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (!isset($_FILES['proof']) || $_FILES['proof']['error'] !== UPLOAD_ERR_OK) {
    header("Location: /BMS/CODES/register.php?error=file_upload");
    exit();
}

$file_name = $_FILES['proof']['name'];
$file_tmp  = $_FILES['proof']['tmp_name'];
$file_size = $_FILES['proof']['size'];
$file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

$allowed = ["jpg", "jpeg", "png", "pdf"];

if (!in_array($file_ext, $allowed)) {
    header("Location: /BMS/CODES/register.php?error=invalid_file");
    exit();
}

if ($file_size > 5 * 1024 * 1024) {
    header("Location: /BMS/CODES/register.php?error=file_too_large");
    exit();
}

$new_file_name = time() . "_" . uniqid() . "." . $file_ext;
$file_path = $upload_dir . $new_file_name;

if (!move_uploaded_file($file_tmp, $file_path)) {
    header("Location: /BMS/CODES/register.php?error=upload_failed");
    exit();
}

/* ---------- PASSWORD HASH ---------- */
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

/* ---------- RESIDENT REGISTRATION ---------- */
if ($account_type === "resident") {

    $check_stmt = mysqli_prepare($conn, "SELECT * FROM residents WHERE username = ? OR email = ?");
    mysqli_stmt_bind_param($check_stmt, "ss", $username, $email);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($check_result) > 0) {
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        header("Location: /BMS/CODES/register.php?error=exists");
        exit();
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO residents (name, username, email, contact_number, password, proof_file, id_number, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
    mysqli_stmt_bind_param($stmt, "sssssss", $name, $username, $email, $contact_number, $hashed_password, $new_file_name, $id_number);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: /BMS/CODES/login.php?register=pending");
        exit();
    } else {
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        header("Location: /BMS/CODES/register.php?error=registration_failed");
        exit();
    }

/* ---------- OFFICIAL REGISTRATION ---------- */
} elseif ($account_type === "official") {

    $valid_departments = ["ADMIN", "BPSO", "CLEARANCE", "LUPON"];

    if (!in_array($department, $valid_departments)) {
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        header("Location: /BMS/CODES/register.php?error=invalid_department");
        exit();
    }

    $check_stmt = mysqli_prepare($conn, "SELECT * FROM officials WHERE username = ? OR email = ?");
    mysqli_stmt_bind_param($check_stmt, "ss", $username, $email);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($check_result) > 0) {
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        header("Location: /BMS/CODES/register.php?error=exists");
        exit();
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO officials (name, username, email, contact_number, password, department, proof_file, id_number, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $username, $email, $contact_number, $hashed_password, $department, $new_file_name, $id_number);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: /BMS/CODES/login.php?register=pending");
        exit();
    } else {
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        header("Location: /BMS/CODES/register.php?error=registration_failed");
        exit();
    }

} else {
    if (file_exists($file_path)) {
        unlink($file_path);
    }
    header("Location: /BMS/CODES/register.php?error=invalid_account_type");
    exit();
}
?>