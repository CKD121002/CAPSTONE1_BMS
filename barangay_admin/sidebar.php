<?php
$currentPage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
?>

<div class="sidebar">

<button id="toggleSidebar" class="toggle-btn">
<i class="fa fa-bars"></i>
</button>

<div class="logo-section">
<img src="/BMS/IMAGES/silogo.png" alt="San Isidro Logo" class="logo1">
</div>

<ul class="nav">

<li>
<a class="nav-link <?php if($currentPage=='admin_dashboard.php') echo 'active'; ?>" href="admin_dashboard.php">
<i class="fa fa-chart-line"></i>
<span>Home</span>
</a>
</li>

<li>
<a class="nav-link <?php if($currentPage=='residents.php') echo 'active'; ?>" href="residents.php">
<i class="fa fa-users"></i>
<span>Residents</span>
</a>
</li>

<li>
<a class="nav-link <?php if($currentPage=='admin_requests.php' || $currentPage=='admin_requests.php') echo 'active'; ?>" href="admin_requests.php">
<i class="fa fa-file-alt"></i>
<span>Documents</span>
</a>
</li>

<li>
<a class="nav-link <?php if($currentPage=='medicine_tracker.php') echo 'active'; ?>" href="medicine_tracker.php">
<i class="fa fa-pills"></i>
<span>Medicine</span>
</a>
</li>

<li>
<a class="nav-link <?php if($currentPage=='barangay_official.php') echo 'active'; ?>" href="barangay_official.php">
<i class="fa fa-user-tie"></i>
<span>Officials</span>
</a>
</li>

<!-- PROFILE MENU -->
<li>
<a class="nav-link <?php if($currentPage=='profile.php') echo 'active'; ?>" href="profile.php">
<i class="fa fa-user-circle"></i>
<span>My Profile</span>
</a>
</li>

<li>
<a class="nav-link logout-btn" href="/BMS/index.php">
<i class="fa fa-sign-out-alt"></i>
<span>Logout</span>
</a>
</li>

</ul>

</div>

<script>
document.getElementById("toggleSidebar").onclick = function(){
document.body.classList.toggle("sidebar-collapsed");
}
</script>