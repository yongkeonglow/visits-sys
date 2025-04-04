<?php
include 'db.php'; // Ensure database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visitor_id = $_POST['visitor_id'];

    // Get current timestamp for check-in
    $checkin_time = date('Y-m-d H:i:s'); // Current date and time

    // Update the visitor's record with check-in time
    $sql = "UPDATE visitor_qr SET checkin_time = '$checkin_time', status = 'IN' WHERE visitor_id = '$visitor_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Visitor checked in at $checkin_time";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!-- HTML form to accept visitor_id for check-in -->
<form method="POST">
    <label for="visitor_id">Visitor ID:</label>
    <input type="text" name="visitor_id" id="visitor_id" required>
    <button type="submit">Check In</button>
</form>
