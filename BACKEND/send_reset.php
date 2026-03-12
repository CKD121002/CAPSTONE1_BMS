<?php
include 'db_connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

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

/*
|--------------------------------------------------------------------------
| IMPORTANT
|--------------------------------------------------------------------------
| If you are testing on the SAME computer only, localhost is fine.
| If you want to open the reset link from another device, replace localhost
| with your computer's local IP, for example:
| http://192.168.1.5/BMS/CODES/reset_pass.php?token=...
*/
$reset_link = "http://localhost/BMS/CODES/reset_pass.php?token=" . urlencode($token);

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'chesterkyle.d@gmail.com';      // CHANGE THIS
    $mail->Password   = 'mnkn nade lvas dmrm'; // CHANGE THIS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Sender and receiver
    $mail->setFrom('chesterkyle.d@gmail.com', 'Barangay San Isidro'); // CHANGE THIS
    $mail->addAddress($email);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';
    $mail->Body = "
        <p>Hello,</p>
        <p>We received a request to reset your password.</p>
        <p>Click the link below to reset it:</p>
        <p><a href='$reset_link'>$reset_link</a></p>
        <p>If you did not request this, you may ignore this email.</p>
    ";

    $mail->AltBody = "Hello,\n\nWe received a request to reset your password.\n\nOpen this link to reset it:\n$reset_link\n\nIf you did not request this, you may ignore this email.";

    $mail->send();

    header("Location: /BMS/CODES/login.php?reset=sent");
    exit();

} catch (Exception $e) {
    die("Email could not be sent. Mailer Error: " . $mail->ErrorInfo);
}
?>