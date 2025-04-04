<?php
include 'db.php'; // Ensure this file connects to your database

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
    $checkin = mysqli_real_escape_string($conn, $_POST['checkin']);
    $checkout = mysqli_real_escape_string($conn, $_POST['checkout']);
    
    // Check if the check-in time is empty
    if (empty($checkin)) {
        die("Error: Check-in time is required.");
    }

    // Insert visitor data into visitors table
    $sql = "INSERT INTO visitors (name, email, phone, purpose) VALUES ('$name', '$email', '$phone', '$purpose')";
    
    if ($conn->query($sql) === TRUE) {
        $visitor_id = $conn->insert_id;
        
        // Insert check-in data into visitor_checkins table
        $sql_checkin = "INSERT INTO visitor_checkins (visitor_id, checkin, checkout) VALUES ('$visitor_id', '$checkin', '$checkout')";
        
        if ($conn->query($sql_checkin) === TRUE) {
            header("Location: view_visitors.php");
            exit();
        } else {
            die("Error in check-in record: " . $conn->error . " | Query: " . $sql_checkin);
        }
    } else {
        die("Error: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Visitor</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Add New Visitor</h2>
        <form method="POST" class="form">
            <label>Name:</label>
            <input type="text" name="name" required><br>

            <label>Email:</label>
            <input type="email" name="email" required><br>

            <label>Phone:</label>
            <input type="text" name="phone" required><br>

            <label>Purpose of Visit:</label>
            <input type="text" name="purpose" required><br>

            <label>Check-in Time:</label>
            <input type="datetime-local" name="checkin" required><br>

            <label>Check-out Time (optional):</label>
            <input type="datetime-local" name="checkout"><br>

            <button type="submit" name="submit">Add Visitor</button>
        </form>
    </div>
</body>
</html>
