<?php
session_start();
include 'config.php';

$month = date('m');
$year = date('Y');

$result = $conn->query("
SELECT s.fullname, s.position, s.daily_rate,
COUNT(a.id) as days_present,
(COUNT(a.id) * s.daily_rate) as total_salary
FROM barangay_staff s
LEFT JOIN attendance a 
ON s.id = a.staff_id 
AND MONTH(a.date)='$month'
AND YEAR(a.date)='$year'
AND a.status='Present'
GROUP BY s.id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Monthly Salary Report</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Salary Report (<?= date('F Y') ?>)</h2>

<table>
<tr>
<th>Name</th>
<th>Position</th>
<th>Daily Rate</th>
<th>Days Present</th>
<th>Total Salary</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['fullname'] ?></td>
<td><?= $row['position'] ?></td>
<td>₱<?= number_format($row['daily_rate'],2) ?></td>
<td><?= $row['days_present'] ?></td>
<td><strong>₱<?= number_format($row['total_salary'],2) ?></strong></td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>