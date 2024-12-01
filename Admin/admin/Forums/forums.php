<?php
    session_start(); 
    require_once('../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: ../../login/login.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clients</title>
        <link rel="stylesheet" href="../../css/common.css">
        <link rel="stylesheet" href="forums.css">  
    </head>

    <body>
        <div class="main">
            <div class="bg">
            
            </div>
            <div>
                <h1>Manage Forums</h1>
    
                <!--This section was replaced by js code-->
                <!--<div class="searchContainer">
                    <form action="" method="POST">
                        <input type="text" name="id" placeholder="Enter Forum ID" required>
                        <button type="submit" name="view">View</button>
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </div>-->
    
                <div id="hiddenView">
                    <button id="closeView" onclick="closeView()">x</button>
                    <center>
                    
                        <p class="forum_th" id="forumId"></p>
                        <p class="forum_th" id="forumTitle"></p>
                        <p class="forum_th" id="createdBy"></p>
                        <p class="forum_th" id="clientId"></p>
                        <p class="forum_th">Content:</p>
                        <p class="content" id="forumContent"></p>
                    
                    </center>
                    
                </div>
    
                <!--This section was replaced by js code-->
                <?php /*        
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
                            } */
                        
                ?>
                <div id="displayArea">
                    <center>
                        <table>
                            <tr>
                                <!--<th>Forum Id</th>-->
                                <th>Title</th>
                                <!--<th>Client ID</th>-->
                                <th>Action</th>
                            </tr>
                            <?php
                                $sql = "SELECT * FROM forums";
                                $result = $conn->query($sql);
    
                                if($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr><!--<td>".$row["forum_id"]."</td>--><td>".$row["title"]."</td><!--<td>".$row["user_id"]."</td>-->
                                        <td class=\"actions\"><center><button class=\"view\" onclick=\"viewForum(" . $row['forum_id'] . ")\">View</button>
                                        <button class=\"del\" onclick=\"deleteForum(" . $row['forum_id'] . ")\">Delete</button></center></td></tr>";
                                    }
                                }
                                else{
                                    echo "<tr><td></td><td><center>0 results</center></td><td></td></tr>";
                                }
    
                            ?>
                        </table>
                    </center>
                </div>
            </div>
        </div>
        <script src="../../js/common.js"></script>
        <script src="forums.js"></script>
    </body>
</html>