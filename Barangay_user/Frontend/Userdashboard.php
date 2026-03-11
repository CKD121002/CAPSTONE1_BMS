<?php
session_start();

include "../Backend/db_connect.php";

/* Check if user is logged in */
if (!isset($_SESSION['resident_id'])){
  header("Location: login.php");
  exit();
}

$resident_id = $_SESSION['resident_id'];

/* Get user info */
$sqlUser = "SELECT * FROM residents WHERE resident_id = '$resident_id'";
$userResult = $conn->query($sqlUser);
$userData = $userResult->fetch_assoc();

/* Get latest 3 requests */
$query = "
SELECT 'Barangay Clearance' AS document, status, submitted_at FROM clearance_permits
UNION
SELECT cert_type AS document, status, submitted_at FROM certifications
UNION
SELECT id_type AS document, status, submitted_at FROM ids
UNION
SELECT report_type AS document, status, submitted_at FROM legal_reports
ORDER BY submitted_at DESC
LIMIT 3
";

$result = $conn->query($query);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barangay Portal</title>
  <link rel="stylesheet" href="../css/CSS.css" />
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
          <a href="Userdashboard.php" class="active">
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
          <a href="History.php">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>History</span>
          </a>
          <a href="#">
            <i class="fa-solid fa-bell"></i>
            <span>Emergency Broadcast</span>
          </a>
          <div class="nav-divider"></div> 
          <a href="../Backend/logout.php">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Log out</span>
          </a>
        </nav>
      </div>
    </aside>

    <main class="maincontent" id="main-content">
      <div class="contentwrapper">
        <header>
          <h1>Good Day, <?= htmlspecialchars($userData['name'])?></h1>
          <h2>What can we help you today?</h2>
        </header>

        <section class="boxcontainer">
          <a href="Request.php" class="usercardcontainer">
            <div class="document">
              <div class="icon"><img src="picture/Clearance.png" alt="Request" class="img"></div>
              <div class="requestboxtext">
                <h3>Request a Document</h3>
                <p>Apply for clearance and permits</p>
              </div>
            </div>
          </a>
          
          <a href="History.php" class="usercardcontainer">
            <div class="tracking">
              <div class="icon">
                <img src="picture/Tracking.png" alt="Track" class="img">
              </div>
              <div class="requestboxtext">
                <h3>Track Request</h3>
                <p>View real-time status updates</p>
              </div>
            </div>
          </a>

          <a href="#" class="usercardcontainer">
            <div class="alert">
              <div class="icon">
                <img src="picture/Alert.png" alt="Alerts" class="img">
              </div>
              <div class="requestboxtext">
                <h3>Emergency Alerts</h3>
                <p>Receive official announcements</p>
              </div>
            </div>
          </a>
          </section>

        <section class="recentrequests">
          <h3>Recent Requests</h3>
          <div class="requestcard"> 
            <?php
            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                $status = $row['status'];
                $statusClass = (in_array($status, ['Approved', 'Complete'])) ? 'complete' : (($status == 'Pending') ? 'pending' : 'cancelled');
                
                echo '<div class="requestrow">';
                echo '<h4>' . ucfirst($row['document']) . '</h4>';
                echo '<p>' . date("M d, Y", strtotime($row['submitted_at'])) . '</p>';
                echo '<span class="status ' . $statusClass . '">' . $status . '</span>';
                echo '</div>';
              }
            } else {
              echo '<p>No recent requests.</p>';
            }
            ?>
          </div>
        </section>
      </div>
      <footer class="footer">
    <div class="footerleft"><div class="footertext">A Centralized Web-based Management System Service</div></div>
    <div class="footercenter">All Rights Reserved</div>
    <div class="footerright">Contact Info Part</div>
  </footer>
    </main>
  </div>
</body>