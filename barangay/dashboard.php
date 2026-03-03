<?php
// dashboard.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

// Fetch counts
$totalResidents = $conn->query("SELECT COUNT(*) as total FROM residents")->fetch_assoc()['total'];
$totalMale = $conn->query("SELECT COUNT(*) as total FROM residents WHERE gender='Male'")->fetch_assoc()['total'];
$totalFemale = $conn->query("SELECT COUNT(*) as total FROM residents WHERE gender='Female'")->fetch_assoc()['total'];
$totalSenior = $conn->query("SELECT COUNT(*) as total FROM residents WHERE age >= 60")->fetch_assoc()['total'];
$totalChild = $conn->query("SELECT COUNT(*) as total FROM residents WHERE age BETWEEN 0 AND 12")->fetch_assoc()['total'];
$totalTeen = $conn->query("SELECT COUNT(*) as total FROM residents WHERE age BETWEEN 13 AND 19")->fetch_assoc()['total'];
$totalAdult = $conn->query("SELECT COUNT(*) as total FROM residents WHERE age BETWEEN 20 AND 59")->fetch_assoc()['total'];
$totalPending = $conn->query("SELECT COUNT(*) as total FROM residents WHERE status='Pending'")->fetch_assoc()['total'];
$totalApproved = $conn->query("SELECT COUNT(*) as total FROM residents WHERE status='Approved'")->fetch_assoc()['total'];
$totalDeclined = $conn->query("SELECT COUNT(*) as total FROM residents WHERE status='Declined'")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">

    </div>
</head>
<body>
    

  <!-- Content -->
     <div class="content">

    <?php include 'sidebar.php'; ?>


    <?php include 'header.php'; ?>


<div class="stats-box mt-4">
    <h5 class="stats-title">Population Stats</h5>
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card bg-primary">
                <h6>Total Residents</h6>
                <h3><?= $totalResidents ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-success">
                <h6>Total Male</h6>
                <h3><?= $totalMale ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-danger">
                <h6>Total Female</h6>
                <h3><?= $totalFemale ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-warning">
                <h6>Senior Citizens</h6>
                <h3><?= $totalSenior ?></h3>
                
            </div>
        </div>
    </div>
</div>
<div class="stats-box mt-4">
    <h5 class="stats-title">User Tracker</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="stat-card bg-warning">
                <h6>Pending</h6>
                <h3><?= $totalPending ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card bg-success">
                <h6>Approved</h6>
                <h3><?= $totalApproved ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card bg-danger">
                <h6>Declined</h6>
                <h3><?= $totalDeclined ?></h3>
            </div>
        </div>
    </div>
</div>



    <!-- Charts -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card"><div class="card-header bg-primary text-white">Population Distribution</div>
                <div class="card-body"><div class="chart-container"><canvas id="populationChart"></canvas></div></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card"><div class="card-header bg-danger text-white">Age Distribution</div>
                <div class="card-body"><div class="chart-container"><canvas id="ageChart"></canvas></div></div>
            </div>
        </div>
    </div>
</div>


<script>
    const populationMale = <?= $totalMale ?>;
    const populationFemale = <?= $totalFemale ?>;

    const ageChild = <?= $totalChild ?>;
    const ageTeen = <?= $totalTeen ?>;
    const ageAdult = <?= $totalAdult ?>;
    const ageSenior = <?= $totalSenior ?>;
    
</script>
<script src="script.js"></script>

</body>
</html>