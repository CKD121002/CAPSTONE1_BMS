<?php
session_start();
include "db_connect.php";

if (!isset($_SESSION['resident_id'])) {
    header("Location: ../login.php");
    exit();
}

$resident_id = $_SESSION['resident_id'];

// 1. FIX: Match 'full_name' from your HTML form
$full_name = $_POST['full_name'] ?? ''; 
$username  = $_POST['username'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$sex       = $_POST['sex'] ?? '';
$email     = $_POST['email'] ?? '';
$contact   = $_POST['contact_number'] ?? '';
$address   = $_POST['address'] ?? '';

// 2. Handle Profile Picture Upload (Optional)
$profile_pic_query = "";
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
    $target_dir = "../picture/";
    $file_name = time() . "_" . basename($_FILES["profile_pic"]["name"]);
    $target_file = $target_dir . $file_name;
    
    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        // Only update this if you added the profile_pic column to your DB
        $profile_pic_query = ", profile_pic = '$file_name'";
    }
}

// 3. FIX: Changed 'full_name' to 'name' to match your database column
$sql = "UPDATE residents SET 
        name = '$full_name', 
        username = '$username', 
        birthdate = '$birthdate', 
        sex = '$sex', 
        email = '$email', 
        contact_number = '$contact', 
        address = '$address' 
        $profile_pic_query
        WHERE resident_id = $resident_id";

if (mysqli_query($conn, $sql)) {
    header("Location: ../Frontend/Profile.php?success=1");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
?>