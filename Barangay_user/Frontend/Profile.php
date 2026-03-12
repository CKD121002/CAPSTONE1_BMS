<?php
session_start();
include "../Backend/db_connect.php";

/* Check if user is logged in */
if (!isset($_SESSION['resident_id'])) {
    header("Location: ../CODES/login.php");
    exit();
}

$resident_id = $_SESSION['resident_id'];

/* Get resident information */
$sql = "SELECT * FROM residents WHERE resident_id = '$resident_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Profile</title>

<link rel="stylesheet" href="../css/Profile.css">
<link rel="stylesheet" href="../css/Global.css">
<link rel="stylesheet" href="../css/Sidenav.css">
<link rel="stylesheet" href="../css/Footer.css">
<script src="../js/js.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<div class="container">

<aside class="sidebar" id="sidebar">
       <div class="burgertab" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
          </div>
      <div class="sidebarcontent">
        <div class="sidebar-header">
          <div class="logosidebar">
            <img src="../picture/Logo.png" alt="Barangay Logo" id="sidebarLogo">
          </div>
        </div>

        <nav class="navlinks">
          <a href="Userdashboard.php">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
          </a>
          <a href="Profile.php" class="active">
            <i class="fa-solid fa-user"></i>
            <span>My Profile</span>
          </a>
          <a href="Request.php">
            <i class="fa-solid fa-file-circle-plus"></i>
            <span>Request a Document</span>
          </a>
          <a href="History.php">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>History</span>
          </a>
          <div class="nav-divider"></div> 
          <a href="../Backend/logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Log out</span>
          </a>
        </nav>
      </div>
    </aside>

<main class="maincontent profilebg">

<div class="contentwrapper">

<h1 class="profiletitle">My Profile</h1>

<div class="profilesection">

<div class="profilecard">

<div class="profileheader">

<div class="avatarcontainer">
    <div class="avatar-wrapper">
        <?php 
            // Checks if profile_pic column has data; falls back to dog.jpg if empty
            $userPic = (!empty($user['profile_pic'])) ? "../picture/" . $user['profile_pic'] : "../picture/dog.jpg";
        ?>
        <img src="<?= htmlspecialchars($userPic) ?>" alt="Profile Picture" class="profilepic"/>
    </div>
</div>

<div class="userheadline">
<h2><?php echo $user['name']; ?></h2>
<p>Resident of Barangay San Isidro</p>
</div>

<a href="Editprofile.php" class="btneditprofile">Edit Profile</a>

</div>
</div>

<div class="detailssection">
<h3>Personal Information</h3>
<div class="formsection">
<div class="formgroup">

<label>Full Name</label>
<p class="infotext"><?php echo $user['name']; ?></p>

<label>Sex</label>
<p class="infotext"><?php echo $user['sex']; ?></p>

<label>Birthdate</label>
<p class="infotext"><?php echo $user['birthdate']; ?></p>

<label>ID Number</label>
<p class="infotext"><?php echo $user['id_number']; ?></p>

</div>

<div class="formgroup">

<label>Username</label>
<p class="infotext"><?php echo $user['username']; ?></p>

<label>Email Address</label>
<p class="infotext"><?php echo $user['email']; ?></p>

<label>Contact Number</label>
<p class="infotext"><?php echo $user['contact_number']; ?></p>

<label>Current Address</label>
<p class="infotext"><?php echo $user['address']; ?></p>

</div>

</div>
</div>

</div>
</div>
<footer class="footer">
    <div class="footerleft"><div class="footertext">A Centralized Web-based Management System Service</div></div>
    <div class="footercenter">All Rights Reserved</div>
    <div class="footerright">Contact Info Part</div>
  </footer>
</main>
</div>
</body>
</html>