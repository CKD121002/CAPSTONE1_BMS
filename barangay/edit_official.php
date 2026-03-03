<?php
include 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID");
}

$id = intval($_GET['id']);

// Get official
$stmt = $conn->prepare("SELECT * FROM officials WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Official not found.");
}

$row = $result->fetch_assoc();

if (isset($_POST['update'])) {

    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $description = trim($_POST['description']);

    if (empty($name) || empty($position)) {
        echo "Name and Position are required.";
    } else {

        $update = $conn->prepare("UPDATE officials 
                                  SET name=?, position=?, description=? 
                                  WHERE id=?");

        $update->bind_param("sssi", $name, $position, $description, $id);

        if ($update->execute()) {
            header("Location: barangay_official.php");
            exit();
        } else {
            echo "Update failed.";
        }
    }
}
?>

<form method="POST">
    <h2>Edit Official</h2>

    <input type="text" name="name" 
           value="<?php echo htmlspecialchars($row['name']); ?>" required><br><br>

    <input type="text" name="position" 
           value="<?php echo htmlspecialchars($row['position']); ?>" required><br><br>

    <textarea name="description"><?php echo htmlspecialchars($row['description']); ?></textarea><br><br>

    <button type="submit" name="update">Update</button>
</form>