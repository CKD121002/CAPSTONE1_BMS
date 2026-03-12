<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $position = $_POST['position'];

    $sql = "INSERT INTO officials (name, position) 
            VALUES ('$name','$position')";

    $conn->query($sql);

    header("Location: barangay_official.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
 <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/sidebar.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/barangay_official.css">
</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="main-wrapper">

<?php include 'header.php'; ?>

<div class="content">

<h2 class="page-title">
<i class="fa fa-users"></i> Barangay Officials
</h2>


<!-- ADD OFFICIAL -->
<div class="card-box">

<form method="POST">

<div class="form-row">

<input type="text" name="name" placeholder="Full Name" required>

<input type="text" name="position" placeholder="Position" required>

<button type="submit" name="submit" class="btn-add">
<i class="fa fa-plus"></i> Add Official
</button>

</div>

</form>

</div>


<!-- TABLE -->
<div class="card-box">

<div class="table-container">

<table>

<tr>
<th>Name</th>
<th>Position</th>
<th>Date Added</th>
<th>Tools</th>
</tr>

<?php
$result = $conn->query("SELECT id,name,position,date_added FROM officials ORDER BY id DESC");

if($result->num_rows == 0){
echo "<tr><td colspan='4' style='text-align:center;'>No records found</td></tr>";
}else{

while($row = $result->fetch_assoc()){
?>

<tr>

<td><?php echo htmlspecialchars($row['name']); ?></td>

<td><?php echo htmlspecialchars($row['position']); ?></td>

<td><?php echo $row['date_added'] ?? 'N/A'; ?></td>

<td>

<a href="edit_official.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">
<i class="fa fa-edit"></i>
</a>

<a href="delete_official.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger"
onclick="return confirm('Delete this official?');">
<i class="fa fa-trash"></i>
</a>

</td>

</tr>

<?php
}
}
?>

</table>

</div>
</div>

</div>
</div>

<script src="sidebar.js"></script>

</body>
</html>