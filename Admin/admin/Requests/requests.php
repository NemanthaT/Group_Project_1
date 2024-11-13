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
        <title>Provider Requests</title>
        <link rel="stylesheet" href="requests.css">
        <link rel="stylesheet" href="../../css/common.css">
    </head>

    <body>
    <div id="hiddenView">
            <button id="closeView" onclick="closeView()">x</button>
            <p><b>Viewing Forum ID:</b> <span id="forumId"></span></p>
            <p><b>Title:</b> <span id="forumTitle"></span></p>
            <p><b>Client ID:</b> <span id="clientId"></span></p>
            <p><b>Content:</b></p>
            <div class="content" id="forumContent"></div>
        </div>
        <center>
            <table>
                <tr>
                    <th>Request Id</th>
                    <th>Field</th>
                    <th>specialty</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM providerrequests";
                    $result = $conn->query($sql);

                    if($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>".$row["reqId"]."</td><td>".$row["field"]."</td><td>".$row["specialty"]."</td>
                            <td class=\"actions\"><center><button onclick=\"viewForum(" . $row['reqId'] . ")\">View</button>
                            <button onclick=\"deleteForum(" . $row['reqId'] . ")\">Delete</button></center></td></tr>";
                        }
                    }
                    else{
                        echo "<tr><td></td><td>0 results</td><td></td></tr>";
                    }

                ?>
            </table>
        </center>   
    </body>

</html>