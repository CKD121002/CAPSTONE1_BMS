<?php
include 'config.php';

if(isset($_POST['submit'])){
    $satellite = $_POST['satellite_id'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    $conn->query("INSERT INTO satellite_reports (satellite_id, report_title, report_message)
                  VALUES ('$satellite','$title','$message')");

    echo "<script>alert('Report Submitted Successfully!');</script>";
}

$satellites = $conn->query("SELECT * FROM satellites WHERE status='Active'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Submit Satellite Report</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Submit Report</h2>

<form method="POST">
<select name="satellite_id" required>
<option value="">Select Satellite</option>
<?php while($row=$satellites->fetch_assoc()): ?>
<option value="<?= $row['id'] ?>"><?= $row['satellite_name'] ?></option>
<?php endwhile; ?>
</select>

<input type="text" name="title" placeholder="Report Title" required>
<textarea name="message" placeholder="Report Details" required></textarea>
<button name="submit">Submit Report</button>
</form>

</body>
</html>