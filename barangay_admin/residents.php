<?php
session_start();
include 'config.php';

/* -------- APPROVE -------- */
if(isset($_GET['approve'])){
    $id = intval($_GET['approve']);
    $conn->query("UPDATE residents SET status='Approved' WHERE id=$id");
    header("Location: codes/residents.php");
}

/* -------- DECLINE -------- */
if(isset($_GET['decline'])){
    $id = intval($_GET['decline']);
    $conn->query("UPDATE residents SET status='Declined' WHERE id=$id");
    header("Location: codes/residents.php");
}

/* -------- GET RESIDENTS -------- */
$result = $conn->query("SELECT * FROM residents ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Residents</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/sidebar.css">
    <link rel="stylesheet" href="style/header.css">
    
    <link rel="stylesheet" href="style/residents.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main-wrapper">

<?php include 'header.php'; ?>

<div class="content">

<h2>Residents List</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Address</th>
<th>Satellite</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?= $row['id'] ?></td>
<td><?= $row['fullname'] ?></td>
<td><?= $row['address'] ?></td>
<td><?= $row['satellite'] ?></td>

<td>
<?php
$status = $row['status'];

if($status == "Pending"){
echo "<span class='status-pending'>Pending</span>";
}

if($status == "Approved"){
echo "<span class='status-approved'>Approved</span>";
}

if($status == "Declined"){
echo "<span class='status-declined'>Declined</span>";
}
?>
</td>

<td>

<?php if($status == "Pending"){ ?>

<a href="?approve=<?= $row['id'] ?>">
<button class="btn btn-approve">
<i class="fa fa-check"></i> Approve
</button>
</a>

<a href="?decline=<?= $row['id'] ?>">
<button class="btn btn-decline">
<i class="fa fa-times"></i> Decline
</button>
</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>