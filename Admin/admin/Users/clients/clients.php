<?php
    session_start(); 
    require_once('../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: ../../login/login.php");
        exit;
    }

    $sql = "SELECT * FROM clients";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clients</title>
        <link rel="stylesheet" href="../../css/common.css">
        <link rel="stylesheet" href="peopleStyles.css">
        <script src="users.js"></script>   
    </head>

    <body>
        <div class="main">
            <div class="bg">
                    <!--blur Background image-->  
            </div>
            <div>
                <h1>Clients</h1>
                <div id="hiddenView">
                    <button id="closeView" onclick="closeView()">x</button>
                    <center>
                    <table>
                        <tr><th class="c_th">Client ID:</th> <td id="cId"></td></tr>
                        <tr><th class="c_th">Username:</th> <td id="uName"></td></tr>
                        <tr><th class="c_th">Full Name:</th> <td id="fName"></td></tr>
                        <tr><th class="c_th">email:</th><td id="email"></td></tr>
                        <tr><th class="c_th">Address:</th><td id="address"></td></tr>
                    </table>
                    </center>
                    
                </div>
                <div id="displayArea">
                    <center>
                        <table>
                            <tr>
                                <!--<th>UId</th>-->
                                <th>Username</th>
                                <th>Email</th>
                                <th>Actions</th>

                            </tr>
                        <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr><!--<td>" . $row["client_id"]. "</td>--><td>" . $row["username"]. "</td><td>" . $row["email"]. "</td><td class=\"actions\"><center><button class=\"view\" onclick=\"viewClient(".$row["client_id"].")\">View</button><button class=\"del\" onclick=\"deleteClient(".$row["client_id"].")\">Delete</button></center></td></tr>";
                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                        ?>
                        </table>
                    </center>
                </div>
            </div>
        </div>
    </body>
</html>