<!DOCTYPE html>
<html>
<head>
    <title>Visitor QR Scanner</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
</head>
<body>
    <h2>Scan Visitor QR Code</h2>
    <div id="reader" style="width:300px;"></div>
    <div id="result" style="margin-top:20px;"></div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            fetch("process_scan.php?data=" + decodedText)
                .then(res => res.text())
                .then(data => {
                    document.getElementById("result").innerHTML = data;
                });
        }

        new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 }).render(onScanSuccess);
    </script>
</body>
</html>
