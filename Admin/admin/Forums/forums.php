<?php
    session_start(); 
    require_once('../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clients</title>
        <link rel="stylesheet" href="forums.css">
    </head>

    <body>
        <h1>Manage Forums</h1>
        <center>
            <table>
                <tr>
                    <th>Forum Id</th>
                    <th>Title</th>
                    <th>Client ID</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM forums";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>".$row["forum_id"]."</td><td>".$row["title"]."</td><td>".$row["user_id"]."</td></tr>";
                        }
                    }

                ?>
            </table>
        </center>
        <div class="container">
            <form action="" method="POST">
                <input type="text" name="id" placeholder="Enter Forum ID" required>
                <button type="submit" name="view">View</button>
                <button type="submit" name="delete">Delete</button>
            </form>
        </div>
        <div>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['view'])) {
                        $id=$_POST['id'];
                        $sql = "SELECT * FROM forums WHERE forum_id = $id";
                        $opert=$conn->query($sql);
                        $row = $opert->fetch_assoc();
                        echo "<p>Viewing Forum ID: ". $row["forum_id"]."</p>";
                        echo "<p>Title: ". $row["title"]."</p>";
                        echo "<p>Client ID: ". $row["user_id"]."</p>";
                        echo "<p>Content: " . "<div class=\"content\"><p>" . $row["content"]."</p></div>" . "</p>";
                    }
                    if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['delete'])) {
                        $id=$_POST['id'];
                        $sql = "DELETE FROM forums WHERE forum_id = $id";
                        $opert=$conn->query($sql);
                        echo "Deleting";
                    }
                ?>
        </div>            
        
    </body>
</html>