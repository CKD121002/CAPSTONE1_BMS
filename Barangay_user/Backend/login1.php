<?php
session_start();
include "db_connect.php";

if (!isset($_POST['account_type'], $_POST['username'], $_POST['password'])) {
    header("Location: /BMS/CODES/login.php?error=1");
    exit();
}

$account_type = $_POST['account_type'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($account_type == "resident") {

    $sql = "SELECT * FROM residents 
            WHERE username='$username' 
            AND password='$password' 
            AND status='pending'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        $_SESSION['resident_id'] = $row['resident_id'];
        $_SESSION['username'] = $row['username'];

        header("Location: ../Frontend/Userdashboard.php");
exit();

    } else {
        header("Location: ../Frontend/login.php?error=1");
exit();
    }

} elseif ($account_type == "official") {

    $sql = "SELECT * FROM officials 
            WHERE username='$username' 
            AND password='$password' 
            AND status='active'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);
        $department = $row['department'];

        $_SESSION['username'] = $row['username'];
        $_SESSION['department'] = $department;

        if ($department == "ADMIN") {
            header("Location: /BMS/CODES/admin_dashboard.php");
        } elseif ($department == "BPSO") {
            header("Location: /BMS/CODES/bpso_dashboard.php");
        } elseif ($department == "CLEARANCE") {
            header("Location: /BMS/CODES/dashboard.php");
        } elseif ($department == "LUPON") {
            header("Location: /BMS/CODES/lupon_dashboard.php");
        } else {
            header("Location: /BMS/CODES/login.php?error=1");
        }
        exit();

    } else {
        header("Location: /BMS/CODES/login.php?error=1");
        exit();
    }

} else {
    header("Location: /BMS/CODES/login.php?error=1");
    exit();
}
?>