<?php
// Include the database connection file
require '../connect/connect.php';

if(isset($_POST['submit'])){
    // Get form data
    $worker_id = $_POST['worker_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        
        // Insert data into the database
        $sql = "INSERT INTO your_table_name (worker_id, title, content, image, created_at) 
                VALUES ('$worker_id', '$title', '$content', '$image', NOW())";
        
        if ($conn->query($sql) === TRUE) {
            echo "Record added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the image.";
    }
}

// Close the connection
$conn->close();
?>
