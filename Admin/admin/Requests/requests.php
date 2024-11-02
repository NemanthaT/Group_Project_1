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
        <title>Service Requests</title>
        <link rel="stylesheet" href="requests.css">
    </head>

    <body>
        <div id="table">
            <table>
                <tr>
                    <th>
                </tr>
            </table>
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