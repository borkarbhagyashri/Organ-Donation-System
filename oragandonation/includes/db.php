<?php
$conn = new mysqli("localhost", "root", "admin123!", "donation");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
