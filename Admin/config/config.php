<?php
/*$db_host = 'localhost'; // database host
$db_name = 'edsaLanka'; // database name
$db_user = 'root'; // database username
$db_pass = ''; // database password*/

$servername = "mysql-edsa.alwaysdata.net";
$username = "edsa";
$password = "123@safran"; 
$dbname = "edsa_lanka"; 


// Connect to the database
/*$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);*/

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>