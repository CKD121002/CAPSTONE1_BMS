<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<div class="topbar">

    <!-- LEFT -->
    <div class="topbar-left">
        <h2 class="system-title">
            <i class="fa fa-city"></i> Barangay Management System
        </h2>
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

        <!-- Profile Dropdown -->
        <div class="profile" onclick="toggleProfile()">
            <i class="fa fa-user-circle"></i>
            <span><?= htmlspecialchars($_SESSION['user']) ?></span>
            <i class="fa fa-caret-down"></i>

            <div class="dropdown-menu" id="profileMenu">
                <a href="#"><i class="fa fa-user"></i> My Profile</a>
                <a href="#"><i class="fa fa-cog"></i> Settings</a>
                <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
            </div>
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