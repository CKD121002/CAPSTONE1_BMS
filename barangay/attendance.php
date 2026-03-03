<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Add Staff
if (isset($_POST['add_staff'])) {
    $name = $_POST['fullname'];
    $position = $_POST['position'];
    $rate = $_POST['daily_rate'];

    $conn->query("INSERT INTO barangay_staff (fullname, position, daily_rate) 
                  VALUES ('$name','$position','$rate')");
    header("Location: attendance.php");
}

// Time In
if (isset($_GET['timein'])) {
    $id = $_GET['timein'];
    $date = date('Y-m-d');
    $time = date('H:i:s');

    $check = $conn->query("SELECT * FROM attendance WHERE staff_id='$id' AND date='$date'");
    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO attendance (staff_id,date,time_in,status)
                      VALUES ('$id','$date','$time','Present')");
    }
    header("Location: attendance.php");
}

// Time Out
if (isset($_GET['timeout'])) {
    $id = $_GET['timeout'];
    $date = date('Y-m-d');
    $time = date('H:i:s');

    $row = $conn->query("SELECT * FROM attendance WHERE staff_id='$id' AND date='$date'")->fetch_assoc();

    if ($row && !$row['time_out']) {
        $timeIn = strtotime($row['time_in']);
        $timeOut = strtotime($time);
        $hours = round(($timeOut - $timeIn)/3600,2);

        $conn->query("UPDATE attendance 
                      SET time_out='$time', total_hours='$hours'
                      WHERE staff_id='$id' AND date='$date'");
    }
    header("Location: attendance.php");
}

$staff = $conn->query("SELECT * FROM barangay_staff WHERE status='Active'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Barangay Attendance System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Content -->
     <div class="content">

    <?php include 'sidebar.php'; ?>


    <?php include 'header.php'; ?>


<div class="stats-box mt-4">
            <h2>Barangay Attendance Management</h2>
       
    <h3>Add Staff / Official</h3>
<form method="POST">
    <input type="text" name="fullname" placeholder="Full Name" required>
    <input type="text" name="position" placeholder="Position" required>
    <input type="number" step="0.01" name="daily_rate" placeholder="Daily Rate" required>
    <button name="add_staff">Add</button>
</form>

<hr>

<h3>Staff Attendance (<?= date('F d, Y') ?>)</h3>

<table>
<tr>
<th>Name</th>
<th>Position</th>
<th>Daily Rate</th>
<th>Time In</th>
<th>Time Out</th>
<th>Total Hours</th>
<th>Action</th>
</tr>

<?php
while($row = $staff->fetch_assoc()):
$date = date('Y-m-d');
$att = $conn->query("SELECT * FROM attendance WHERE staff_id='".$row['id']."' AND date='$date'");
$data = $att->fetch_assoc();
?>

<tr>
<td><?= $row['fullname'] ?></td>
<td><?= $row['position'] ?></td>
<td>₱<?= number_format($row['daily_rate'],2) ?></td>
<td><?= $data['time_in'] ?? '-' ?></td>
<td><?= $data['time_out'] ?? '-' ?></td>
<td><?= $data['total_hours'] ?? '-' ?></td>
<td>
    <?php if(!$data): ?>
        <a class="btn" href="?timein=<?= $row['id'] ?>">Time In</a>
    <?php elseif(!$data['time_out']): ?>
        <a class="btn red" href="?timeout=<?= $row['id'] ?>">Time Out</a>
    <?php else: ?>
        Completed
    <?php endif; ?>
</td>
</tr>

<?php endwhile; ?>

</table>

<br>
<a href="salary_report.php" class="salary-btn">View Salary Report</a>

</div>
<script src="script.js"></script>
</body>
</html>