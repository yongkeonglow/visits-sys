<?php
$servername = "localhost";
$username = "root"; // Change if needed
$password = "";
$dbname = "visitor_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
date_default_timezone_set('Asia/Kuala_Lumpur'); // Set your timezone

$conn = new mysqli("localhost", "root", "", "visitor_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
