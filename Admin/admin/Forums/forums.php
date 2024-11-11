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
        <link rel="stylesheet" href="../../css/common.css">
    </head>

    <body>
        <h1>Manage Forums</h1>
        <div class="searchContainer">
            <form action="" method="POST">
                <input type="text" name="id" placeholder="Enter Forum ID" required>
                <button type="submit" name="view">View</button>
                <button type="submit" name="delete">Delete</button>
            </form>
        </div>
        <?php         
                    if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['view'])) {
                        $id=$_POST['id'];
                        $sql = "SELECT * FROM forums WHERE forum_id = $id";
                        $opert=$conn->query($sql);
                        $row = $opert->fetch_assoc();
                        echo "<div class=\"viewSpace\">";
                        echo "<p><b>Viewing Forum ID: </b>". $row["forum_id"]."</p>";
                        echo "<p><b>Title: </b>". $row["title"]."</p>";
                        echo "<p><b>Client ID: </b>". $row["user_id"]."</p>";
                        echo "<p><b>Content: </b>" . "<div class=\"content\"><p>" . $row["content"]."</p></div>" . "</p>";
                        echo "</div>"; 
                    }
                    if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['delete'])) {
                        $id=$_POST['id'];
                        $sql = "DELETE FROM forums WHERE forum_id = $id";
                        $opert=$conn->query($sql);
                        echo "Deleting";
                    }
                   
        ?>

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
                            echo "<tr><td>".$row["forum_id"]."</td><td>".$row["title"]."</td><td>".$row["user_id"]."</td>
                            <td><button onclick=\"viewContent(" . $row['forum_id'] . ")\">View</button>
                            <button onclick=\"deleteContent(" . $row['forum_id'] . ")\">Delete</button></td></tr>";
                        }
                    }
                    else{
                        echo "<tr><td></td><td>0 results</td><td></td></tr>";
                    }

                ?>
            </table>
        </center>   
        <script src="../../js/common.js"></script>
    </body>
</html>