<?php
// Database Configuration
$host = "localhost";  // Change if using a remote database
$user = "root";       // Your MySQL username
$pass = "";           // Your MySQL password (default is empty for XAMPP)
$dbname = "finance_tracker"; // Replace with your actual database name

// Create Connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check Connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
