<?php
$conn = new mysqli("localhost", "root", "admin123", "library_db");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
