<?php
$servername = "mysql-edsa.alwaysdata.net";
$username = "edsa";
$password = "123@safran"; 
$dbname = "edsa_lanka"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>