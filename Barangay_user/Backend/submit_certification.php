<?php
include "../../BACKEND/db_connect.php";

$fullname = $_POST['fullname'];
$birthdate = $_POST['birthdate'];
$cert_type = $_POST['cert_type'];
$purpose = $_POST['purpose'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];

$attachment = NULL;
if(isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0){
    $target_dir = "../uploads/";
    // Using time() prevents files with the same name from overwriting each other
    $filename = time() . "_" . basename($_FILES["attachment"]["name"]);
    $attachment_path = $target_dir . $filename;
    
    if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $attachment_path)){
        $attachment = $filename; // Store only the filename in the database
    }
}

$stmt = $conn->prepare("INSERT INTO certifications (fullname, birthdate, cert_type, purpose, phone, email, address, attachment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $fullname, $birthdate, $cert_type, $purpose, $phone, $email, $address, $attachment);

if($stmt->execute()){
    // Redirects to dashboard with success status
    header("Location: ../Frontend/Userdashboard.php?status=success");
    exit();
} else {
    // Redirects to dashboard with error status if the query fails
    header("Location: ../Frontend/Userdashboard.php?status=error");
    exit();
}

$stmt->close();
$conn->close();
?>