<?php

$conn = new mysqli("localhost","root","","barangay_user_db");

if($conn->connect_error){
die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['id'])){

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM document_requests WHERE id='$id'");
$row = $result->fetch_assoc();

}

?>

<!DOCTYPE html>
<html>
<head>

<title>View Request</title>
     <link rel="stylesheet" href="style/view_request.css">
   

</head>

<body>

<div class="container">

<h2>Request Details</h2>

<table>

<tr>
<td><b>ID</b></td>
<td><?php echo $row['id']; ?></td>
</tr>

<tr>
<td><b>Resident Name</b></td>
<td><?php echo $row['resident_name']; ?></td>
</tr>

<tr>
<td><b>Document Type</b></td>
<td><?php echo $row['document_type']; ?></td>
</tr>

<tr>
<td><b>Purpose</b></td>
<td><?php echo $row['purpose']; ?></td>
</tr>

<tr>
<td><b>Status</b></td>
<td><?php echo $row['status']; ?></td>
</tr>

<tr>
<td><b>Request Date</b></td>
<td><?php echo $row['request_date']; ?></td>
</tr>

</table>

<center>

<a href="admin_requests.php">
<button>Back</button>
</a>

</center>

</div>

</body>
</html>