<?php
include 'config.php';

$result = $conn->query("
SELECT r.*, s.satellite_name 
FROM satellite_reports r
JOIN satellites s ON r.satellite_id=s.id
ORDER BY r.report_date DESC
LIMIT 5
");

$count = $conn->query("SELECT COUNT(*) as total FROM satellite_reports WHERE report_status='Unread'")
               ->fetch_assoc()['total'];

$data = [];

while($row=$result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode([
    'count'=>$count,
    'reports'=>$data
]);