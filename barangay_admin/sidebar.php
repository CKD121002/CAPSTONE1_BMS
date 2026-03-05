<body>

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        
        <button id="toggleSidebar" class="toggle-btn"><i class="fa fa-bars"></i></button>
    </div>

    <a href="index.php" class="nav-link"><i class="fa fa-chart-line"></i><span>Dashboard</span></a>
    <a href="residents.php" class="nav-link" ><i class="fa fa-users"></i><span>Residents</span></a>
     <a href="medicine_tracker.php" class="nav-link"><i class="fa fa-users"></i><span>Medicine Tracker</span></a>

   <?php $page = basename($_SERVER['PHP_SELF']); ?>

<div class="nav-group">
    <div class="nav-link submenu-toggle">
        <i class="fa fa-file-alt"></i>
        <span>Documents</span>
        <i class="fa fa-caret-down caret"></i>
    </div>

    <div class="submenu">
        <a href="document_list.php?type=Barangay Clearance"
           class="<?= (isset($_GET['type']) && $_GET['type']=='Barangay Clearance') ? 'active-sub' : '' ?>">
           Clearance
        </a>

        <a href="document_list.php?type=Barangay Business Permit Certificate"
           class="<?= (isset($_GET['type']) && $_GET['type']=='Barangay Business Permit Certificate') ? 'active-sub' : '' ?>">
           Permit
        </a>

        <a href="document_list.php?type=Barangay Indigency Certificate"
           class="<?= (isset($_GET['type']) && $_GET['type']=='Barangay Indigency Certificate') ? 'active-sub' : '' ?>">
           Indigency
        </a>
    </div>
</div>

    <?php if($_SESSION['role']=='Admin'): ?>
   <a href="barangay_official.php" class="nav-link "><i class="fa fa-user-cog"></i><span>Barangay Official</span></a>
    <?php endif; ?>

    <a href="attendance.php" class="nav-link"><i class="fa fa-calendar-check"></i><span>Attendance</span></a>
</a>

    <a href="logout.php" class="nav-link"><i class="fa fa-sign-out-alt"></i><span>Logout</span></a>
</div>