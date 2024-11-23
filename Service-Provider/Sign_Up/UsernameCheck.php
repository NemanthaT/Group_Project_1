<?php
// check_username.php
require_once('../connection.php'); // Include database connection

if (isset($_GET['username'])) {
    $username = mysqli_real_escape_string($conn, $_GET['username']);
    
    // Check if username exists
    $query = "SELECT * FROM serviceproviders WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo "Username is already taken.";
    } else {
        echo "Username is available.";
    }
    
    mysqli_close($conn);
}
?>
