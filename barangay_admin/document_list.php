<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$type = $_GET['type'] ?? '';

/* APPROVE */
if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    $conn->query("UPDATE document_requests SET status='Approved' WHERE id='$id'");
    header("Location: document_list.php?type=".$type);
    exit();
}

/* DISAPPROVE */
if(isset($_GET['disapprove'])){
    $id = $_GET['disapprove'];
    $conn->query("UPDATE document_requests SET status='Disapproved' WHERE id='$id'");
    header("Location: document_list.php?type=".$type);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?= $type ?> Requests</title>
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

    <h4><?= $type ?> Requests</h4>
    <a href="documents.php" class="btn-back">
        <i class="fa fa-arrow-left"></i> Back
    </a>
</div>



<table>
<tr>
<th>ID</th>
<th>Resident Name</th>
<th>Purpose</th>
<th>Date Requested</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM document_requests 
                        WHERE document_type='$type'
                        ORDER BY id DESC");

while($row = $result->fetch_assoc()):
?>

<tr>
<td><?= $row['id'] ?></td>
<td><?= $row['resident_name'] ?></td>
<td><?= $row['purpose'] ?></td>
<td><?= date('F d, Y', strtotime($row['request_date'])) ?></td>

<td>
<?php
if($row['status']=="Pending")
    echo "<span class='status-badge warning'>Pending</span>";
elseif($row['status']=="Approved")
    echo "<span class='status-badge success'>Approved</span>";
else
    echo "<span class='status-badge danger'>Disapproved</span>";
?>
</td>

<td>
<?php if($row['status']=="Pending"): ?>
<a class="btn-success"
href="?type=<?= urlencode($type) ?>&approve=<?= $row['id'] ?>">
Approve</a>

<a class="btn-danger"
href="?type=<?= urlencode($type) ?>&disapprove=<?= $row['id'] ?>">
Disapprove</a>
<?php else: ?>
Completed
<?php endif; ?>
</td>

</tr>

<?php endwhile; ?>

</table>

</div>
</div>
<script src="script.js"></script>
</body>
</html>