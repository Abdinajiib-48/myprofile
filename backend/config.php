<?php
// backend/config.php
// This file connects your PHP code to the database

// Database connection settings
$host = "localhost";      // XAMPP runs database here
$username = "root";        // Default XAMPP username
$password = "";            // Default XAMPP password (empty)
$database = "profile_db";  // The database we created

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check if connection worked
if ($conn->connect_error) {
    // If connection fails, stop the script and show error
    die("Connection failed: " . $conn->connect_error);
}
else 
    echo "connection is successful!";


// If we get here, connection is successful!
// We don't need to show a message, just keep the connection ready
?>