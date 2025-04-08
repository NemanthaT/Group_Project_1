<?php
  session_start(); 
  require_once '../../config/config.php';

  $username = $_SESSION['username'];
  $email = $_SESSION['email'];

  if (!isset($_SESSION['username'])) { // if not logged in
      header("Location: ../../Login/Login.php");
      exit;
  }

if (isset($_GET['delete_id'])) {
    // Sanitize the input
    $news_id = intval($_GET['delete_id']); // Convert to integer to prevent SQL injection

    // Verify the ID is valid
    if ($news_id > 0) {
        // Correct column name (replace `news_id` with your actual column name)
        $sql = "DELETE FROM `news` WHERE news_id = $news_id";

        // Debugging: Display the query (comment this out in production)
        echo "Executing query: $sql";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Redirect to the updatedelete.php page on success
            echo "<script>
                    alert('Deleted Successfully');
                    window.location.href = 'updatedelete.php';
                  </script>";
            exit();
        } else {
            // Display the error message
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid ID provided.";
    }
} else {
    echo "No ID provided.";
}
?>
