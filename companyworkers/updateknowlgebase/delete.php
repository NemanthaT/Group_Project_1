<?php
include '../connect.php';

if (isset($_GET['delete_id'])) {
    // Sanitize the input
    $kb_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection

    // Verify the ID is valid
    if ($kb_id > 0) {
        // Correct column name (replace `kb_id` with your actual column name)
        $sql = "DELETE FROM `knowledgebase` WHERE kb_id = $kb_id";

        // Debugging: Display the query (comment this out in production)
        echo "Executing query: $sql";

        // Execute the query
        $result = mysqli_query($con, $sql);

        if ($result) {
            // Redirect to the updatedelete.php page on success
            echo "<script>
                    alert('Deleted Successfully');
                    window.location.href = 'updatedelete.php';
                  </script>";
            exit();
        } else {
            // Display the error message
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Invalid ID provided.";
    }
} else {
    echo "No ID provided.";
}
?>
