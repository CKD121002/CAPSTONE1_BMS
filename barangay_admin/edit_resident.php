<?php
include 'config.php';
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM residents WHERE id=$id")->fetch_assoc();

if(isset($_POST['update'])){
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $civil = $_POST['civil_status'];
    $sector = $_POST['sector'];

    $conn->query("UPDATE residents SET 
        fullname='$fullname',
        gender='$gender',
        age='$age',
        civil_status='$civil',
        sector='$sector'
        WHERE id=$id");

    header("Location: residents.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Resident</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card">
<div class="card-header bg-warning">Edit Resident</div>
<div class="card-body">

<form method="POST">
<input type="text" name="fullname" value="<?= $data['fullname'] ?>" class="form-control mb-2">
<input type="number" name="age" value="<?= $data['age'] ?>" class="form-control mb-2">

<select name="gender" class="form-control mb-2">
<option <?= $data['gender']=="Male"?"selected":"" ?>>Male</option>
<option <?= $data['gender']=="Female"?"selected":"" ?>>Female</option>
<option <?= $data['gender']=="Non-Binary"?"selected":"" ?>>Non-Binary</option>
</select>

<select name="civil_status" class="form-control mb-2">
<option <?= $data['civil_status']=="Single"?"selected":"" ?>>Single</option>
<option <?= $data['civil_status']=="Married"?"selected":"" ?>>Married</option>
<option <?= $data['civil_status']=="Separated"?"selected":"" ?>>Separated</option>
<option <?= $data['civil_status']=="Widow/ER"?"selected":"" ?>>Widow/ER</option>
</select>

<select name="sector" class="form-control mb-3">
<option <?= $data['sector']=="None"?"selected":"" ?>>None</option>
<option <?= $data['sector']=="Senior Citizen"?"selected":"" ?>>Senior Citizen</option>
<option <?= $data['sector']=="Solo Parent"?"selected":"" ?>>Solo Parent</option>
<option <?= $data['sector']=="PWD"?"selected":"" ?>>PWD</option>
</select>

<button type="submit" name="update" class="btn btn-success">Update</button>
<a href="residents.php" class="btn btn-secondary">Back</a>

</form>

</div>
</div>
</div>

</body>
</html>