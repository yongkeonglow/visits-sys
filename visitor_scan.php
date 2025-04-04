<?php
include 'db.php';
?>

<h2>Visitor Records</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>NRIC</th>
        <th>Contact</th>
        <th>Purpose</th>
        <th>Check-In</th>
        <th>Check-Out</th>
        <th>QR Code</th>
    </tr>
    <?php
    $sql = "SELECT * FROM visitors ORDER BY id DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['nric']."</td>
                <td>".$row['contact']."</td>
                <td>".$row['purpose']."</td>
                <td>".$row['check_in']."</td>
                <td>".(!empty($row['check_out']) ? $row['check_out'] : '<span style="color:red;">Not checked out</span>')."</td>
                <td>".(!empty($row['qr_code']) ? "<img src='".$row['qr_code']."' width='80'/>" : "No QR")."</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No visitors found</td></tr>";
    }
    ?>
</table>
