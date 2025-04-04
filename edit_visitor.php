<?php
include 'db.php'; // Ensure this file connects to your database

$row = ['id' => '', 'name' => '', 'phone' => '', 'purpose' => '', 'check_in' => '', 'check_out' => '']; // Default values

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM visitors WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Visitor not found!'); window.location='view_visitors.php';</script>";
        exit();
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $purpose = $_POST['purpose'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    $update_sql = "UPDATE visitors SET 
    name='$name', 
    phone='$phone', 
    purpose='$purpose', 
    check_in='$check_in', 
    check_out='$check_out' 
    WHERE id=$id";
    
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Visitor updated successfully!'); window.location='view_visitors.php';</script>";
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
    <title>Edit Visitor</title>
</head>
<body>
    <h2>Edit Visitor</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>
        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required><br>
        <label>Purpose:</label>
        <input type="text" name="purpose" value="<?php echo htmlspecialchars($row['purpose']); ?>" required><br>
        <label>Check-In:</label>
        <input type="datetime-local" name="check_in" value="<?php echo !empty($row['check_in']) ? date('Y-m-d\TH:i', strtotime($row['check_in'])) : ''; ?>"><br>
        <label>Check-Out:</label>
        <input type="datetime-local" name="check_out" value="<?php echo !empty($row['check_out']) ? date('Y-m-d\TH:i', strtotime($row['check_out'])) : ''; ?>"><br>
        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
