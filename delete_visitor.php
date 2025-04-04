<?php
include 'db.php'; // Ensure this file connects to your database

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Secure ID input

    // Check if visitor exists
    $check_sql = "SELECT * FROM visitors WHERE id = $id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Delete visitor
        $delete_sql = "DELETE FROM visitors WHERE id = $id";
        
        if ($conn->query($delete_sql) === TRUE) {
            echo "<script>alert('Visitor deleted successfully!'); window.location='view_visitors.php';</script>";
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "<script>alert('Visitor not found!'); window.location='view_visitors.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request!'); window.location='view_visitors.php';</script>";
    exit();
}
?>
