<?php
include 'config.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $position = $_POST['position'];
    $description = $_POST['description'];

    $picture = $_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], "uploads/".$picture);

    $sql = "INSERT INTO officials (picture,name,position,description)
            VALUES ('$picture','$name','$position','$description')";

    $conn->query($sql);

    header("Location: barangay_official.php");
}
?>

<form method="POST" enctype="multipart/form-data">
    <h2>Add Official</h2>
    <input type="file" name="picture" required><br>
    <input type="text" name="name" placeholder="Full Name" required><br>
    <input type="text" name="position" placeholder="Position" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <button type="submit" name="submit">Save</button>
</form>