<?php
$db_host = 'localhost'; // database host
$db_name = 'edsaLanka'; // database name
$db_user = 'root'; // database username
$db_pass = ''; // database password

// Connect to the database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>