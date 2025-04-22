<?php
$servername = "mysql-edsa.alwaysdata.net";
$username = "edsa";
$password = "123@safran"; 
$dbname = "edsa_lanka"; 


// // Database configuration
// $servername = "127.0.0.1";  // Usually 'localhost' or '127.0.0.1' for local setup
// $username = "root";          // Replace with your database username
// $password = "";              // Replace with your database password
// $dbname = "edsalanka"; // Replace with your actual database name
$servername = "mysql-edsa.alwaysdata.net";  // Usually 'localhost' or '127.0.0.1' for local setup
$username = "edsa";          // Replace with your database username
$password = "123@safran";              // Replace with your database password
$dbname = "edsa_lanka"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
