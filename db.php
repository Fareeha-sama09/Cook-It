<?php
// Database connection settings
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'cookit';

// Create connection with error handling
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    // Do not expose sensitive info in production
    die('Database connection failed. Please try again later.');
}

// Set charset for security and compatibility
$conn->set_charset('utf8mb4');
?>
