<?php
include 'db.php';
include "phpqrcode/qrlib.php"; // Include the PHP QR Code library

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $visitor_id = uniqid('VIS'); // Generate unique visitor ID

    // Create the 'qrcodes' directory if it doesn't exist
    if (!is_dir('qrcodes')) {
        mkdir('qrcodes', 0777, true);
    }

    // Save to DB
    $sql = "INSERT INTO visitor_qr (visitor_id, name) VALUES ('$visitor_id', '$name')";
    mysqli_query($conn, $sql);

    // Generate QR code and save it to the 'qrcodes' directory
    $qrContent = $visitor_id; // You can include more info in the QR code
    $qrFile = "qrcodes/$visitor_id.png";
    QRcode::png($qrContent, $qrFile);

    echo "<h2>QR Code for $name</h2>";
    echo "<img src='$qrFile' style='width:200px;'><br>";
    echo "Visitor ID: $visitor_id<br><br>";
}
?>

<!-- HTML form to create a visitor and generate a QR code -->
<form method="POST">
    <input type="text" name="name" placeholder="Visitor Name" required>
    <button type="submit">Generate QR</button>
</form>
