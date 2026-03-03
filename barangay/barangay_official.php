<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Barangay Officials Management</title>
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
    <a href="add_official.php" class="btn">+ New Official</a>
    <a href="export.php" class="btn export">Export</a>

    <input type="text" id="search" placeholder="Search...">

    <table id="officialTable">
        <tr>
            <th>Picture</th>
            <th>Name</th>
            <th>Position</th>
            <th>Description</th>
            <th>Date Added</th>
            <th>Tools</th>
        </tr>

        <?php
$result = $conn->query("SELECT id, picture, name, position, description, date_added FROM officials ORDER BY id DESC");

if (!$result) {
    die("Database Error: " . $conn->error);
}

if ($result->num_rows == 0) {
    echo "<tr><td colspan='6' style='text-align:center;'>No records found in database</td></tr>";
} else {
    while($row = $result->fetch_assoc()) {
?>
<tr>
    <td>
        <?php if(!empty($row['picture'])): ?>
            <img src="uploads/<?php echo htmlspecialchars($row['picture']); ?>" width="50">
        <?php else: ?>
            No Image
        <?php endif; ?>
    </td>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['position']); ?></td>
    <td><?php echo htmlspecialchars($row['description']); ?></td>
    <td><?php echo $row['date_added'] ?? 'N/A'; ?></td>
    <td>
        <a href="edit_official.php?id=<?php echo $row['id']; ?>" class="edit">Edit</a>
        <a href="delete_official.php?id=<?php echo $row['id']; ?>" 
   class="delete"
   onclick="return confirm('Are you sure you want to delete this official?');">
   Delete
</a>
    </td>
</tr>
<?php
    }
}
?>

    </table>
</div>

<script src="script.js"></script>
</body>
</html>