<?php
$host = 'localhost'; // Host (can be 'localhost' if running locally)
$username = 'root'; // Your MySQL username (default: root)
$password = ''; // Your MySQL password (default: empty for localhost)
$database = 'bncc'; // The name of the database you created

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
