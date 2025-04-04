<?php
include 'db.php'; // Ensure this file connects to your database

$row = ['id' => '', 'name' => '', 'phone' => '', 'address' => '']; // Default values

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM residents WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Resident not found!'); window.location='view_residents.php';</script>";
        exit();
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $update_sql = "UPDATE residents SET name='$name', phone='$phone', address='$address' WHERE id=$id";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Resident updated successfully!'); window.location='view_residents.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resident</title>
</head>
<body>
    <h2>Edit Resident</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>
        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required><br>
        <label>Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
