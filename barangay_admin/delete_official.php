<?php
include 'config.php';

$id = $_GET['id'];
$conn->query("DELETE FROM officials WHERE id=$id");

header("Location: barangay_official.php");
?>