<?php
session_start();
include 'config.php';

$currentPage = basename($_SERVER['PHP_SELF']); // e.g., "residents.php"
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

/* ---------------- ADD RESIDENT ---------------- */
if(isset($_POST['add'])){
   $fullname = $conn->real_escape_string($_POST['fullname']);
$address = $conn->real_escape_string($_POST['address']);
$gender = $_POST['gender'];
$age = $_POST['age'];
$civil_status = $_POST['civil_status'];
$sector = $_POST['sector'];

/* AUTO ASSIGN SATELLITE FROM ADDRESS */
$satellite = 0;

$map = $conn->query("SELECT * FROM satellite_mapping");

while($m = $map->fetch_assoc()){
    if(stripos($address, $m['address_keyword']) !== false){
        $satellite = $m['satellite'];
        break;
    }
}

/* INSERT RESIDENT */
$conn->query("INSERT INTO residents
(fullname,address,gender,age,civil_status,sector,satellite,status)
VALUES
('$fullname','$address','$gender','$age','$civil_status','$sector','$satellite','Pending')");
}
/* ---------------- UPDATE STATUS ---------------- */
if(isset($_GET['approve'])){
    $id = intval($_GET['approve']);
    $conn->query("UPDATE residents SET status='Approved' WHERE id=$id");
}

if(isset($_GET['decline'])){
    $id = intval($_GET['decline']);
    $conn->query("UPDATE residents SET status='Declined' WHERE id=$id");
}

/* ---------------- DELETE RESIDENT ---------------- */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM residents WHERE id=$id");

}

?>

<!DOCTYPE html>
<html>
<head>
<title>Residents Management - Barangay San Isidro</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="content">

<?php include 'sidebar.php'; ?>


    <?php include 'header.php'; ?>

    

    <!-- ADD FORM -->
    <div class="stats-box mt-4">
        <div class="stats-title">Add Resident</div>
        <div class="card-body">
            <form method="POST">
                <div class="row g-2">
                    <div class="col-md-3">
                        <input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
                    </div>
                     <div class="col-md-3">
                        <input type="text" name ="address" class="form-control" placeholder="address" required>
                    </div>
                    <div class="col-md-2">
                        <select name="gender" class="form-control">
                            <option>Male</option>
                            <option>Female</option>
                            <option>Non-Binary</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="age" class="form-control" placeholder="Age" required>
                    </div>
                    <div class="col-md-2">
                        <select name="civil_status" class="form-control">
                            <option>Single</option>
                            <option>Married</option>
                            <option>Separated</option>
                            <option>Widow/ER</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sector" class="form-control">
                            <option>None</option>
                            <option>Senior Citizen</option>
                            <option>Solo Parent</option>
                            <option>PWD</option>
                        </select>
                    </div>
                    
                    <div class="col-md-1">
                        <button type="submit" name="add" class="btn btn-success w-100">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- RESIDENTS TABLE -->
    <div class="card">
        <div class="card-header bg-dark text-white">Residents List</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Civil Status</th>
                       <th>Sector</th>
                       <th>Status</th>
                       <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM residents ORDER BY id DESC");
                    while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['fullname'] ?></td>
    <td><?= $row['address'] ?></td>
    <td><?= $row['gender'] ?></td>
    <td><?= $row['age'] ?></td>
    <td><?= $row['civil_status'] ?></td>
    <td><?= $row['sector'] ?></td>
    <td><?= $row['status'] ?></td>
    

    <!-- STATUS BADGE -->
    <td>
        <?php if($row['status'] == 'Pending'){ ?>
            <span class="status-badge bg-warning">Pending</span>
        <?php } elseif($row['status'] == 'Approved'){ ?>
            <span class="status-badge bg-success">Approved</span>
        <?php } else { ?>
            <span class="status-badge bg-danger">Declined</span>
        <?php } ?>
    </td>

    <!-- ACTION BUTTONS -->
    <td>
        <?php if($row['status'] == 'Pending'){ ?>
            <a href="?approve=<?= $row['id'] ?>" class="btn btn-success btn-sm">Approve</a>
            <a href="?decline=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Decline</a>
        <?php } ?>

        <a href="edit_resident.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this resident?')">Delete</a>
    </td>
</tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Burger Menu Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebar");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("collapsed");
        });
    }

    // Submenu toggle
    document.querySelectorAll(".submenu-toggle").forEach(function(toggle) {
        toggle.addEventListener("click", function() {
            this.parentElement.classList.toggle("open");
        });
    });
});
</script>

</body>
</html>