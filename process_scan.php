<?php
include "db.php";

$visitor_id = $_GET['data'];

$query = "SELECT * FROM visitor_qr WHERE visitor_id = '$visitor_id'";
$result = mysqli_query($conn, $query);
$visitor = mysqli_fetch_assoc($result);

if ($visitor) {
    $name = $visitor['name'];
    $status = $visitor['status'];

    if ($status == 'IN') {
        mysqli_query($conn, "UPDATE visitor_qr SET status='OUT', checkout_time=NOW() WHERE visitor_id='$visitor_id'");
        echo "<h3>$name has checked OUT</h3>";
    } else {
        mysqli_query($conn, "UPDATE visitor_qr SET status='IN', checkin_time=NOW() WHERE visitor_id='$visitor_id'");
        echo "<h3>$name has checked IN</h3>";
    }

    echo "<p>ID: $visitor_id</p>";
    echo "<p>New Status: " . ($status == 'IN' ? 'OUT' : 'IN') . "</p>";
    echo "<p>Timestamp: " . date("Y-m-d H:i:s") . "</p>";
} else {
    echo "<p>Visitor not found.</p>";
}
?>
