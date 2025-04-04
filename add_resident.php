<?php
include 'db.php'; // Ensure this file connects to your database

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Insert into database
    $sql = "INSERT INTO residents (name, phone, address) VALUES ('$name', '$phone', '$address')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Resident added successfully!'); window.location='view_residents.php';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Resident</title>
</head>
<body>
    <h2>Add New Resident</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Phone:</label>
        <input type="text" name="phone" required><br>

        <label>Address:</label>
        <input type="text" name="address" required><br>

        <button type="submit" name="submit">Add Resident</button>
    </form>
</body>
</html>
