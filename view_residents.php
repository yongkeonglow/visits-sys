<?php
include 'db.php'; // Ensure this file connects to your database

// Handle deletion
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']); // Ensure ID is an integer to prevent SQL injection
    $delete_sql = "DELETE FROM residents WHERE id = $id";
    
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Resident deleted successfully!'); window.location='view_residents.php';</script>";
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch residents data
$sql = "SELECT * FROM residents";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Residents</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
</head>
<body>
    <h2>Residents List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = htmlspecialchars($row['id']);
                $name = htmlspecialchars($row['name']);
                $phone = htmlspecialchars($row['phone']);
                $address = isset($row['address']) ? htmlspecialchars($row['address']) : 'N/A'; // Prevent undefined error

                echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$phone</td>
                    <td>$address</td>
                    <td>
                        <a href='edit_resident.php?id=$id'>Edit</a>
                        <a href='view_residents.php?delete_id=$id' onclick='return confirm(\"Are you sure you want to delete this resident?\")'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No residents found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
