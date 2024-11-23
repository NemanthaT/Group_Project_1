<?php
// Include the database connection file
require '../connect/connect.php';

// Query to fetch the image and other data from the database
$sql = "SELECT title, content, image FROM news WHERE news_id = 1"; // Replace '1' with the actual id
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h1>" . $row['title'] . "</h1>";
    echo "<p>" . $row['content'] . "</p>";
    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"/>'; // Displays the image
} else {
    echo "No results found.";
}





// Close the connection
$conn->close();
?>
