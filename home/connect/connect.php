<?php
$servername = "127.0.0.1"; // or the IP address of the server
$username = "root";    // replace with your database username
$password = "";    // replace with your database password
$dbname = "serviceplatform"; // replace with your database name
                                                                                          
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>
