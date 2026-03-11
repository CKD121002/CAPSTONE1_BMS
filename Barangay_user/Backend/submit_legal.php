<?php
include "db_connect.php";

$fullname = $_POST['fullname'];
$birthdate = $_POST['birthdate'];
$report_type = $_POST['report_type'];
$purpose = $_POST['purpose'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];

$attachment = NULL;
if(isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0){
    $target_dir = "../uploads/";
    $attachment = $target_dir . basename($_FILES["attachment"]["name"]);
    move_uploaded_file($_FILES["attachment"]["tmp_name"], $attachment);
}

$stmt = $conn->prepare("INSERT INTO legal_reports (fullname, birthdate, report_type, purpose, phone, email, address, attachment) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $fullname, $birthdate, $report_type, $purpose, $phone, $email, $address, $attachment);

if($stmt->execute()){
    echo "Legal/Incident report submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>