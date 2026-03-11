<?php
include 'db_connect.php';

$token = trim($_POST['token'] ?? '');
$password = trim($_POST['password'] ?? '');
$confirm = trim($_POST['confirm_password'] ?? '');

if (empty($token) || empty($password) || empty($confirm)) {
    die("All fields are required.");
}

if ($password !== $confirm) {
    die("Passwords do not match.");
}

$sql = "SELECT email, account_type FROM password_resets WHERE token = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Invalid token.");
}

$row = $result->fetch_assoc();
$email = $row['email'];
$account_type = $row['account_type'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($account_type === "official") {
    $sql = "UPDATE officials SET password = ? WHERE email = ?";
} else {
    $sql = "UPDATE residents SET password = ? WHERE email = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $hashed_password, $email);

if (!$stmt->execute()) {
    die("Failed to update password.");
}

$sql = "DELETE FROM password_resets WHERE token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();

header("Location: /BMS/CODES/login.php?reset=success");
exit();
?>