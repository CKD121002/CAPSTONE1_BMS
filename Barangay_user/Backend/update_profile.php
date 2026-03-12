<?php
session_start();
include "../../BACKEND/db_connect.php";

if (!isset($_SESSION['resident_id'])) {
    header("Location: /BMS/CODES/login.php");
    exit();
}

$resident_id = $_SESSION['resident_id'];

// Match form fields
$full_name = $_POST['full_name'] ?? ''; 
$username  = $_POST['username'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$sex       = $_POST['sex'] ?? '';
$email     = $_POST['email'] ?? '';
$contact   = $_POST['contact_number'] ?? '';
$address   = $_POST['address'] ?? '';

// Handle Profile Picture Upload
$profile_picture_query = "";

if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $target_dir = "../picture/";
    $file_name = time() . "_" . basename($_FILES["profile_picture"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $profile_picture_query = ", profile_picture = '$file_name'";
    }
}

$sql = "UPDATE residents SET 
        name = '$full_name', 
        username = '$username', 
        birthdate = '$birthdate', 
        sex = '$sex', 
        email = '$email', 
        contact_number = '$contact', 
        address = '$address'
        $profile_picture_query
        WHERE resident_id = '$resident_id'";

if (mysqli_query($conn, $sql)) {
    header("Location: ../Frontend/Profile.php?success=1");
    exit();
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
?>