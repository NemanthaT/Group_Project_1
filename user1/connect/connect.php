<?php


// Database configuration
$servername = "127.0.0.1";  // Usually 'localhost' or '127.0.0.1' for local setup
$username = "root";          // Replace with your database username
$password = "";              // Replace with your database password
$dbname = "edsalanka"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } else {
//     echo "Connected successfully";
// }

?>