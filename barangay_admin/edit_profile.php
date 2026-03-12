<?php
session_start();
$conn = new mysqli("localhost","root","","barangay_db");

if(!isset($_SESSION['username'])){
    echo "User not logged in.";
    exit();
}

$username = $_SESSION['username'];

/* GET CURRENT DATA */
$result = $conn->query("SELECT * FROM officials WHERE username='$username'");
$row = $result->fetch_assoc();


/* UPDATE PROFILE */
if(isset($_POST['update'])){

$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact_number'];
$id_number = $_POST['id_number'];
$department = $_POST['department'];

/* IMAGE UPLOAD */
if($_FILES['profile']['name'] != ""){

$filename = $_FILES['profile']['name'];
$tempname = $_FILES['profile']['tmp_name'];

move_uploaded_file($tempname,"uploads/".$filename);

$conn->query("UPDATE officials SET
name='$name',
email='$email',
contact_number='$contact',
id_number='$id_number',
department='$department',
proof_file='$filename'
WHERE username='$username'");

}else{

$conn->query("UPDATE officials SET
name='$name',
email='$email',
contact_number='$contact',
id_number='$id_number',
department='$department'
WHERE username='$username'");

}

header("Location: profile.php");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Profile</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="style/main.css">
<link rel="stylesheet" href="style/sidebar.css">
<link rel="stylesheet" href="style/header.css">
<link rel="stylesheet" href="style/edit_profile.css">


</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="main-wrapper">

<?php include 'header.php'; ?>

<div class="content">

<div class="edit-card">

<h2>Edit Profile</h2>

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
<label>Full Name</label>
<input type="text" name="name" value="<?php echo $row['name']; ?>" required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" value="<?php echo $row['email']; ?>">
</div>

<div class="form-group">
<label>Contact Number</label>
<input type="text" name="contact_number" value="<?php echo $row['contact_number']; ?>">
</div>

<div class="form-group">
<label>ID Number</label>
<input type="text" name="id_number" value="<?php echo $row['id_number']; ?>">
</div>

<div class="form-group">
<label>Department</label>
<input type="text" name="department" value="<?php echo $row['department']; ?>">
</div>

<div class="form-group">
<label>Profile Picture</label>
<input type="file" name="profile">
</div>

<button type="submit" name="update" class="update-btn">
Update Profile
</button>

</form>

</div>

</div>
<script src="style/sidebar.js"></script>
</body>
</html>