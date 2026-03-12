<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="css/header.css">
<div class="topbar">

    <!-- LEFT -->
   <div class="logo-area">
            <img src="/BMS/IMAGES/silogo.png" alt="San Isidro Logo" class="logo1">
          <a><i class="wow"></i>
<span>
<div class="user-title">
    <?php
    if(isset($_SESSION['username'])){
        echo "Welcome, " . $_SESSION['username'];
    } else {
        echo "Welcome, Guest";
    }
    ?>
</div>
</span>
</a>
        </div>

    <!-- RIGHT -->
    <div class="topbar-right">

        <!-- Live Clock -->
        <div class="clock" id="liveClock"></div>

        <!-- Notification -->
        <div class="notif-icon" onclick="toggleNotif()">
            <i class="fa fa-bell"></i>
            <span class="badge">3</span>
        </div>

    </div>
</div>

<script>
// Live Clock
function updateClock() {
    const now = new Date();
    document.getElementById("liveClock").innerHTML =
        now.toLocaleDateString() + " | " + now.toLocaleTimeString();
}
setInterval(updateClock, 1000);
updateClock();

// Toggle Profile Dropdown
function toggleProfile() {
    document.getElementById("profileMenu").classList.toggle("show");
}

// Dummy notification toggle
function toggleNotif() {
    alert("Notification panel coming soon!");
}

// Close dropdown if clicked outside
window.onclick = function(e) {
    if (!e.target.closest('.profile')) {
        document.getElementById("profileMenu").classList.remove("show");
    }
}
</script>