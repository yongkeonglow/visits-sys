<?php
include 'db.php'; // Ensure this file connects to your database

// Fetch visitor data from visitor_qr
$sql = "SELECT visitor_id, name, status, checkin_time, checkout_time FROM visitor_qr";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Visitors</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            border: 1px solid black !important;
        }

        th {
            color: grey !important;
            background-color: rgba(2, 12, 255, 0.3) !important;
            font-family: 'Courier New', Courier, monospace;
        }
        
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        th #th2 {
            background-color: rgba(134, 222, 166, 0.3) !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Visitors List</h2>
        <table border="1">
            <tr>
                <th>Visitor ID</th>
                <th id="th2">Name</th>
                <th>Status</th>
                <th id="th2">Check-In</th>
                <th>Check-Out</th>
                <th>Actions</th>
            </tr>
            <?php
            // Loop through the result set and display the data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['visitor_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['status']}</td>
                        <td>" . ($row['checkin_time'] ? $row['checkin_time'] : 'Not Available') . "</td>
                        <td>" . ($row['checkout_time'] ? $row['checkout_time'] : 'Not Available') . "</td>
                        <td>
                            <a href='edit_visitor.php?id={$row['visitor_id']}'>Edit</a> |
                            <a href='delete_visitor.php?id={$row['visitor_id']}'>Delete</a>
                        </td>
                    </tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
