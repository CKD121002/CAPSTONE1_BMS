<?php
session_start();
include "config.php";
$conn = new mysqli("localhost","root","","barangay_db");
if(!isset($_SESSION['username'])){
    echo "User not logged in.";
    exit();
}

$username = $_SESSION['username'];

/* GET USER DATA */
$query = $conn->query("SELECT * FROM officials WHERE username='$username'");
$row = $query->fetch_assoc();

/* ATTENDANCE CHECK */
$date = date("Y-m-d");

$clockStatus = "clockin";

$result = $conn->query("
SELECT * FROM attendance 
WHERE username='$username' AND date='$date'
");

if($result && $result->num_rows > 0){

$att = $result->fetch_assoc();

if($att['clock_out'] == NULL){
$clockStatus = "clockout";
}else{
$clockStatus = "done";
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>My Profile</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="style/main.css">
<link rel="stylesheet" href="style/sidebar.css">
<link rel="stylesheet" href="style/header.css">
<link rel="stylesheet" href="style/profile.css">

</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="main-wrapper">

<?php include 'header.php'; ?>

<div class="content">

<div class="page-title">
My Profile
</div>

<!-- PROFILE HEADER -->

<div class="profile-header">

<div class="profile-left">

<?php
$profile = !empty($row['proof_file']) ? $row['proof_file'] : "default.png";
?>

<img src="uploads/<?php echo $profile; ?>" class="profile-avatar">

<div>

<div class="profile-name">
<?php echo $row['name']; ?>
</div>

<div class="profile-sub">
Barangay Official
</div>

</div>

</div>

<div class="profile-actions">

<a href="edit_profile.php" class="edit-profile-btn">
Edit Profile
</a>

<form action="attendance_process.php" method="POST">

<?php if($clockStatus == "clockin"){ ?>

<button type="submit" name="action" value="clockin" class="clock-btn clock-in">
Clock In
</button>

<?php } elseif($clockStatus == "clockout"){ ?>

<button type="submit" name="action" value="clockout" class="clock-btn clock-out">
Clock Out
</button>

<?php } else { ?>

<button class="clock-btn" disabled>Completed</button>

<?php } ?>

</form>

</div>

</div>

<!-- PERSONAL INFO -->

<div class="info-card">

<div class="info-title">
Personal Information
</div>

<div class="info-grid">

<div class="info-item">
<label>Full Name</label>
<p><?php echo $row['name']; ?></p>
</div>

<div class="info-item">
<label>Email Address</label>
<p><?php echo $row['email']; ?></p>
</div>

<div class="info-item">
<label>Username</label>
<p><?php echo $row['username']; ?></p>
</div>

<div class="info-item">
<label>Contact Number</label>
<p><?php echo $row['contact_number']; ?></p>
</div>

<div class="info-item">
<label>ID Number</label>
<p><?php echo $row['id_number']; ?></p>
</div>

<div class="info-item">
<label>Department</label>
<p><?php echo $row['department']; ?></p>
</div>

</div>

</div>

</div>
</div>

</body>
</html>