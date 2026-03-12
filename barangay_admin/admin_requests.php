<?php
session_start();
$conn = new mysqli("localhost","root","","barangay_user_db");

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

/* UPDATE STATUS */

if(isset($_GET['action']) && isset($_GET['id'])){

$id = $_GET['id'];
$action = $_GET['action'];

if($action == "approve"){
$status = "Approved";
}

if($action == "disapprove"){
$status = "Disapproved";
}

$conn->query("UPDATE document_requests SET status='$status' WHERE id='$id'");

header("Location: document_requests.php");
exit();

}

/* GET DATA */

$result = $conn->query("SELECT * FROM document_requests ORDER BY request_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/sidebar.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/admin_requests.css">
<title>Resident Document Requests</title>



</head>

<body>
<?php include 'sidebar.php'; ?>

<div class="main-wrapper">

<?php include 'header.php'; ?>

<div class="content"></div>
<h2>Resident Document Requests</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Document</th>
<th>Purpose</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['resident_name']; ?></td>
<td><?php echo $row['document_type']; ?></td>
<td><?php echo $row['purpose']; ?></td>
<td><?php echo $row['request_date']; ?></td>

<td>

<?php
if($row['status']=="Approved"){
echo "<span style='color:green;font-weight:bold;'>Approved</span>";
}
elseif($row['status']=="Disapproved"){
echo "<span style='color:red;font-weight:bold;'>Disapproved</span>";
}
else{
echo "<span style='color:orange;font-weight:bold;'>Pending</span>";
}
?>

</td>

<td>

<a href="view_request.php?id=<?php echo $row['id']; ?>">
<button class="view">View</button>
</a>

<?php if($row['status']=="Pending"){ ?>

<a href="?action=approve&id=<?php echo $row['id']; ?>">
<button class="approve">Approve</button>
</a>

<a href="?action=disapprove&id=<?php echo $row['id']; ?>">
<button class="disapprove">Disapprove</button>
</a>

<?php } else { ?>

<span style="color:gray;">Completed</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>