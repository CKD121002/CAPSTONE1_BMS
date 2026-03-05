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

$query = "SELECT satellite, COUNT(*) AS total FROM residents  GROUP BY satellite"; $result = $conn->query($query); $satellites = []; while($row = $result->fetch_assoc()){$satellites[$row['satellite']] = $row['total']; }

// Residents needing medicine per satellite

$queryMed = "SELECT satellite, COUNT(*) AS total 
             FROM residents 
             WHERE maintenance_status = 'Needs Maintenance'
             GROUP BY satellite";

$resultMed = $conn->query($queryMed);

$medicineSat = [];

while($row = $resultMed->fetch_assoc()){
    $medicineSat[$row['satellite']] = $row['total'];
}
// Count residents needing maintenance and not needing maintenance
$queryMaintenance = "SELECT 
    SUM(CASE WHEN maintenance_status = 'Needs Maintenance' THEN 1 ELSE 0 END) AS need,
    SUM(CASE WHEN maintenance_status = 'No Maintenance' THEN 1 ELSE 0 END) AS noneed
FROM residents";

$resultMaintenance = $conn->query($queryMaintenance);
$rowMaintenance = $resultMaintenance->fetch_assoc();

$needMaintenance = $rowMaintenance['need'] ?? 0;
$noMaintenance = $rowMaintenance['noneed'] ?? 0;
?>




<!DOCTYPE html>
<head>
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="style.css">
</head>  
<body>
    

  <!-- Content -->
     <div class="content">

    <?php include 'sidebar.php'; ?>


    <?php include 'header.php'; ?>


<div class="stats-box mt-4">
    <h5 class="stats-title">Residents in San Isidro That Using The System</h5>
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card bg-primary">
                <h6>Sattellite 1 Balanti</h6>
                <h3><?= $satellites['Balanti'] ?? 0 ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-success">
                <h6>Satellite 2 Halang</h6>
                <h3><?= $satellites['Halang'] ?? 0 ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-danger">
                <h6>Sattellite 3 Karangalan</h6>
                <h3><?= $satellites['Karangalan'] ?? 0 ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-warning">
                <h6>Satellite 4 Brookside</h6>
                <h3><?= $satellites['Brookside'] ?? 0 ?></h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-good">
                <h6>Sattellite 5 Greenpark</h6>
                <h3><?= $satellites['Greenpark'] ?? 0 ?></h3>
            </div>
        </div>
    </div>
</div>




    <!-- Charts -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card"><div class="card-header bg-primary text-white">Total San Isidro Residents Needing Maintenance Medicine</div>
                <div class="card-body"><div class="satelliteChart"><canvas id="populationChart"></canvas></div></div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card"><div class="card-header bg-danger text-white">Sattellites In San Isidro Needing Maintenance Medicine</div>
                <div class="card-body"><div class="satelliteChart"><canvas id="medicineChart"></canvas></div></div>
            </div>
        </div>
    </div>
</div>


<script>

const medicineData = [
    <?= $medicineSat['Balanti'] ?? 0 ?>,
    <?= $medicineSat['Halang'] ?? 0 ?>,
    <?= $medicineSat['Karangalan'] ?? 0 ?>,
    <?= $medicineSat['Brookside'] ?? 0 ?>,
    <?= $medicineSat['Greenpark'] ?? 0 ?>
];

new Chart(document.getElementById("medicineChart"), {
    type: "bar",
    data: {
        labels: [
            "Balanti",
            "Halang",
            "Karangalan",
            "Brookside",
            "Greenpark"
        ],
        datasets: [{
            label: "Residents Needing Maintenance Medicine",
            data: medicineData,
            backgroundColor: "#dc3545"
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
const maintenanceData = [
    <?= $needMaintenance ?>,
    <?= $noMaintenance ?>
];

new Chart(document.getElementById("populationChart"), {
    type: "doughnut",
    data: {
        labels: [
            "Needs Maintenance",
            "No Maintenance"
        ],
        datasets: [{
            data: maintenanceData,
            backgroundColor: [
                "#dc3545",
                "#28a745"
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

</script>
<script src="script.js"></script>
</body>
</html>

