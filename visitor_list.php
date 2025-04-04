<?php
include "db.php";
$result = mysqli_query($conn, "SELECT * FROM visitor_qr ORDER BY id DESC");
?>

<h2>Visitor List</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>Visitor ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Check-In Time</th>
        <th>Check-Out Time</th>
    </tr>

    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['visitor_id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td><?php echo $row['checkin_time']; ?></td>
        <td><?php echo $row['checkout_time']; ?></td>
    </tr>
    <?php } ?>
</table>
