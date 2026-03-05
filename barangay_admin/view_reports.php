<?php
session_start();
include 'config.php';

$conn->query("UPDATE satellite_reports SET report_status='Read'");

$reports = $conn->query("
SELECT r.*, s.satellite_name
FROM satellite_reports r
JOIN satellites s ON r.satellite_id=s.id
ORDER BY r.report_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Satellite Reports</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>All Satellite Reports</h2>

<table>
<tr>
<th>Satellite</th>
<th>Title</th>
<th>Message</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php while($row=$reports->fetch_assoc()): ?>
<tr class="<?= $row['report_status']=='Unread' ? 'unread':'' ?>">
<td><?= $row['satellite_name'] ?></td>
<td><?= $row['report_title'] ?></td>
<td><?= $row['report_message'] ?></td>
<td><?= $row['report_date'] ?></td>
<td><?= $row['report_status'] ?></td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>