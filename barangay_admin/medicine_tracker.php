<?php
session_start();
include 'config.php';



/* ADD MEDICINE RECORD */
/* ADD MEDICINE RECORD */
if(isset($_POST['add'])){
    

$resident_id = intval($_POST['resident_id']);
$medicine_name = $_POST['medicine_name'] ?? '';
$dosage = $_POST['dosage'] ?? '';
$quantity_given = intval($_POST['quantity_given'] ?? 0);
$quantity_remaining = intval($_POST['quantity_remaining'] ?? 0);
$refill_threshold = intval($_POST['refill_threshold'] ?? 0);
$last_given = $_POST['last_given'] ?? null;
$sat1 = $conn->query("SELECT COUNT(*) as total FROM residents WHERE satellite=1")->fetch_assoc()['total'];
$sat2 = $conn->query("SELECT COUNT(*) as total FROM residents WHERE satellite=2")->fetch_assoc()['total'];
$sat3 = $conn->query("SELECT COUNT(*) as total FROM residents WHERE satellite=3")->fetch_assoc()['total'];
$sat4 = $conn->query("SELECT COUNT(*) as total FROM residents WHERE satellite=4")->fetch_assoc()['total'];
$sat5 = $conn->query("SELECT COUNT(*) as total FROM residents WHERE satellite=5")->fetch_assoc()['total'];


/* INSERT MEDICINE */
$conn->query("INSERT INTO resident_medicine
(resident_id, medicine_name, dosage, quantity_given, quantity_remaining, refill_threshold, last_given)
VALUES
('$resident_id','$medicine_name','$dosage','$quantity_given','$quantity_remaining','$refill_threshold','$last_given')");

/* UPDATE MAINTENANCE STATUS */

if($quantity_remaining <= $refill_threshold){

$conn->query("
UPDATE residents
SET needs_maintenance='Yes'
WHERE id='$resident_id'
");

}else{

$conn->query("
UPDATE residents
SET needs_maintenance='No'
WHERE id='$resident_id'
");

}

}

/* DELETE RECORD */
if(isset($_GET['delete'])){
$id = intval($_GET['delete']);
$conn->query("DELETE FROM resident_medicine WHERE id=$id");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Medicine Tracker</title>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/sidebar.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/dashboard.css">
    <link rel="stylesheet" href="style/medicine_tracker.css">


</head>

<body>
<?php include 'sidebar.php'; ?>

<div class="main-wrapper">

<?php include 'header.php'; ?>

<div class="content">


<h3>Barangay Medicine Tracker</h3>

<!-- ADD FORM -->

<div class="card mb-3">

<div class="card-header bg-primary text-white">
Add Medicine Record
</div>

<div class="card-body">

<form method="POST">

<div class="row g-2">

<div class="col-md-3">

<select name="resident_id" class="form-control" required>

<option value="">Select Resident</option>

<?php

$residents = $conn->query("
SELECT id,fullname
FROM residents
WHERE status='Approved'
ORDER BY fullname
");


while($r = $residents->fetch_assoc()){

?>

<option value="<?= $r['id'] ?>">
<?= $r['fullname'] ?>
</option>

<?php } ?>

</select>

</div>

<div class="col-md-2">
<input type="text" name="medicine_name" class="form-control" placeholder="Medicine Name" required>
</div>

<div class="col-md-2">
<input type="text" name="dosage" class="form-control" placeholder="Dosage">
</div>

<div class="col-md-1">
<input type="number" name="quantity_given" class="form-control" placeholder="Given">
</div>

<div class="col-md-1">
<input type="number" name="quantity_remaining" class="form-control" placeholder="Left">
</div>

<div class="col-md-1">
<input type="number" name="refill_threshold" class="form-control" placeholder="Alert">
</div>

<div class="col-md-2">
<input type="date" name="last_given" class="form-control">
</div>

<div class="col-md-12 mt-2">
<button type="submit" name="add" class="btn btn-success">Add Record</button>
</div>

</div>

</form>

</div>
</div>

<!-- TABLE -->

<div class="card">

<div class="card-header bg-dark text-white">
Resident Medicine Monitoring
</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>Resident</th>
<th>Medicine</th>
<th>Dosage</th>
<th>Remaining</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$result = $conn->query("

SELECT rm.*, r.fullname
FROM resident_medicine rm
JOIN residents r ON rm.resident_id = r.id
ORDER BY rm.id DESC

");

while($row = $result->fetch_assoc()){

$low = $row['quantity_remaining'] <= $row['refill_threshold'];

?>

<tr>

<td><?= $row['fullname'] ?></td>
<td><?= $row['medicine_name'] ?></td>
<td><?= $row['dosage'] ?></td>
<td><?= $row['quantity_remaining'] ?></td>

<td>

<?php if($low){ ?>

<span class="low-medicine">
Low Medicine
</span>

<?php } else { ?>

<span class="normal-medicine">
Normal
</span>

<?php } ?>

</td>

<td>

<a href="?delete=<?= $row['id'] ?>" 
class="btn btn-danger btn-sm"
onclick="return confirm('Delete record?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>
<script src="style/sidebar.js"></script>
</body>
</html>