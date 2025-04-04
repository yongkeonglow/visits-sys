<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $check_out = date("Y-m-d H:i:s");

    $sql = "UPDATE visitors SET check_out = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $check_out, $id);

    if ($stmt->execute()) {
        header("Location: visitor_scan.php"); // Refresh page
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h2>Checkout</h2>
    <form method="POST">

    <label>Check-out Time (optional):</label>
    <input type="datetime-local" name="checkout"><br>

    <button type="submit" name="submit">Checkout</button>
    </form>
</body>
</html>