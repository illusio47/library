<?php
$conn = new mysqli("db", "root", "rootpass", "library_db");

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
