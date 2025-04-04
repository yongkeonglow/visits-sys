<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include "db.php";

// Stats (optional dashboard data)
$totalVisitors = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM visitor_qr"))['total'];
$checkedIn = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM visitor_qr WHERE status='IN'"))['total'];
$checkedOut = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM visitor_qr WHERE status='OUT'"))['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional external CSS -->
</head>
<body>
    <div class="dashboard-container">
        <h1>Admin Panel</h1>
        <p>Welcome, <strong><?php echo $_SESSION['user_name']; ?></strong>!</p>

        <div class="dashboard-stats">
            <p>Total Visitors: <strong><?php echo $totalVisitors; ?></strong></p>
            <p>Currently Checked In: <strong><?php echo $checkedIn; ?></strong></p>
            <p>Checked Out: <strong><?php echo $checkedOut; ?></strong></p>
        </div>
        
        <div class="dashboard-menu">
            <a href="view_residents.php" class="dashboard-item">View Residents</a>
            <a href="visitor_list.php" class="dashboard-item">View Visitors</a>
            <a href="add_resident.php" class="dashboard-item">Add Resident</a>
            <a href="generate_qr.php" class="dashboard-item">Add Visitor (Generate QR)</a>
            <a href="resident_scan.php" class="dashboard-item">Resident Scan</a>
            <a href="scan_qr.php" class="dashboard-item">Visitor Scan (QR)</a>
            <a href="logout.php" class="dashboard-item logout">Logout</a>
        </div>
    </div>
</body>
</html>
