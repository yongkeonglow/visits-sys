<?php
include 'db.php';
include 'phpqrcode/qrlib.php'; // Include phpqrcode library

// Directory to store QR codes
$qr_dir = "qr_codes/";
if (!file_exists($qr_dir)) {
    mkdir($qr_dir, 0777, true);
}

// Fetch residents
$sql = "SELECT * FROM residents ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident QR Scan</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
</head>
<body>
    <h2>Resident QR Code Scanner</h2>

    <!-- QR Scanner -->
    <div id="reader" style="width: 300px;"></div>
    <p>Scanned Result: <span id="scan-result"></span></p>

    <h3>Residents QR Codes</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>QR Code</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = htmlspecialchars($row['id']);
                $name = htmlspecialchars($row['name']);
                $phone = htmlspecialchars($row['phone']);
                $address = htmlspecialchars($row['address']);

                // QR Code Data
                $qr_data = "ID: $id, Name: $name, Phone: $phone, Address: $address";
                $qr_file = $qr_dir . "resident_" . $id . ".png"; // Save QR Code as file

                // Generate QR Code if not exists
                if (!file_exists($qr_file)) {
                    QRcode::png($qr_data, $qr_file, QR_ECLEVEL_L, 4);
                }

                echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$phone</td>
                    <td>$address</td>
                    <td><img src='$qr_file' alt='QR Code'></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No residents found</td></tr>";
        }
        ?>
    </table>

    <script>
        function onScanSuccess(qrCodeMessage) {
            document.getElementById('scan-result').innerText = qrCodeMessage;
            alert("Resident Found: " + qrCodeMessage);
        }

        function onScanError(errorMessage) {
            console.warn(errorMessage);
        }

        var html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            { facingMode: "environment" }, 
            { fps: 10, qrbox: { width: 250, height: 250 } },
            onScanSuccess,
            onScanError
        );
    </script>
</body>
</html>

