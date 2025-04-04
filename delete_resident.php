<?php
include 'db_connection.php'; // Ensure this file connects to your database

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert ID to integer for security

    // Check if the resident exists before deleting
    $check_sql = "SELECT * FROM residents WHERE id = $id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Delete the resident
        $delete_sql = "DELETE FROM residents WHERE id = $id";
        
        if ($conn->query($delete_sql) === TRUE) {
            echo "<script>alert('Resident deleted successfully!'); window.location='view_residents.php';</script>";
            exit();
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    } else {
        echo "<script>alert('Resident not found!'); window.location='view_residents.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Invalid request!'); window.location='view_residents.php';</script>";
    exit();
}
?>
