<?php
include "../../BACKEND/db_connect.php";

/* Get all requests from the 4 tables */
$query = "
SELECT 'Barangay Clearance' AS document, status, submitted_at, approved_at FROM clearance_permits
UNION
SELECT cert_type AS document, status, submitted_at, approved_at FROM certifications
UNION
SELECT id_type AS document, status, submitted_at, approved_at FROM ids
UNION
SELECT report_type AS document, status, submitted_at, approved_at FROM legal_reports
ORDER BY submitted_at DESC
";

$result = $conn->query($query);
?>

<!doctype html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>History</title>

<link rel="stylesheet" href="../css/History.css" />
<link rel="stylesheet" href="../css/Sidenav.css" />
<link rel="stylesheet" href="../css/Global.css" />
<link rel="stylesheet" href="../css/Footer.css" />
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
          <a href="Profile.php">
            <i class="fa-solid fa-user"></i>
            <span>My Profile</span>
          </a>
          <a href="Request.php">
            <i class="fa-solid fa-file-circle-plus"></i>
            <span>Request a Document</span>
          </a>
          <a href="History.php" class="active">
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


<main class="maincontent historybg">

<div class="contentwrapper">

<h1 class="historytitle">My Request History</h1>

<!-- FILTER BUTTONS -->

<div class="filtercontainer">

<button class="filterbtn active" data-filter="all">All</button>

<button class="filterbtn" data-filter="complete">
Complete
</button>

<button class="filterbtn" data-filter="cancelled">
Cancelled
</button>

<button class="filterbtn" data-filter="pending">
Pending
</button>

</div>


<div class="historygrid">

<?php

if($result->num_rows > 0){

while($row = $result->fetch_assoc()){

$status = $row['status'];
$statusClass = "";

/* Status colors */

if($status == "Approved" || $status == "Complete"){
$statusClass = "complete";
}

elseif($status == "Pending"){
$statusClass = "pending";
}

else{
$statusClass = "cancelled";
}

?>

<div class="historycard" data-status="<?php echo $statusClass; ?>">

<div class="cardheader">

<h3><?php echo ucfirst($row['document']); ?></h3>

<span class="<?php echo $statusClass; ?>">
<?php echo $status; ?>
</span>

</div>

<div class="cardbody">

<p><i class="fa-regular fa-calendar"></i> Submitted: <?php echo date("M d, Y h:i A", strtotime($row['submitted_at'])); ?></p>

<?php if (!empty($row['approved_at'])) { ?>
<p><i class="fa-regular fa-clock"></i> Approved: <?php echo date("M d, Y h:i A", strtotime($row['approved_at'])); ?></p>
<?php } ?>

</div>

</div>

<?php
}
}
else{
echo "<p>No request history found.</p>";
}
?>

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