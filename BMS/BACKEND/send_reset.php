<?php
include 'db_connect.php';

$email = trim($_POST['email'] ?? '');

if (empty($email)) {
    die("Email required.");
}

$account_type = "";

/* Check officials */
$sql = "SELECT * FROM officials WHERE email = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $account_type = "official";
} else {
    /* Check residents */
    $sql = "SELECT * FROM residents WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $account_type = "resident";
    }
}

if ($account_type == "") {
    die("Email not found.");
}

/* Delete old reset requests for same email */
$sql = "DELETE FROM password_resets WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

/* Create token */
$token = bin2hex(random_bytes(32));

/* Save token */
$sql = "INSERT INTO password_resets (email, token, account_type) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $email, $token, $account_type);

if (!$stmt->execute()) {
    die("Failed to save token.");
}

/* Redirect to reset page */
header("Location: /BMS/CODES/reset_pass.php?token=" . urlencode($token));
exit();
?>