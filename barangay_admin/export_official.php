<?php
include 'config.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="officials.csv"');

$output = fopen("php://output", "w");

// Correct header
fputcsv($output, array('Name', 'Position', 'Description', 'Date Added'));

$result = $conn->query("SELECT name, position, description, date_added FROM officials ORDER BY id DESC");

if (!$result) {
    die("Database Error: " . $conn->error);
}

while ($row = $result->fetch_assoc()) {
    fputcsv($output, array(
        $row['name'],
        $row['position'],
        $row['description'],
        $row['date_added']
    ));
}

fclose($output);
exit();
?>