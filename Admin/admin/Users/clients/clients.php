<?php
    session_start(); 
    require_once('../../../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    $_SESSION['nRC'] = 'none';

    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: ../../../../login/login.php");
        exit;
    }

    $sql = "SELECT * FROM clients WHERE status = 'set'";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clients</title>
        <link rel="stylesheet" href="../../../css/common.css">
        <link rel="stylesheet" href="../../../css/preloader.css">
        <link rel="stylesheet" href="../peopleStyles.css">
        <script src="../users.js"></script>
        <script src="../../../js/preloader.js"></script> 
    </head>

    <body>
        <div class="main" id="main">
            <div class="bg">
                    <!--blur Background image-->  
            </div>
            <div id="preloader">
                <div class="spinner"></div>
            </div>
            <div id="popupPreloader">
                <div class="spinner"></div>
            </div>

            <div id="overlay" class="overlay"></div>
            
            <div>
                <h1>Clients</h1>
                <div id="hiddenView">                    
                    <div id="hiddenViewHeader">
                        <h2>User Details</h2>
                        <button id="closeView" onclick="closeView()">x</button>
                    </div>
                    <div id="userPic">
                        
                    </div>
                    <div id="hiddenViewDetails">
                        <div class="hiddenViewContent">
                            <p id="deteHead">Client ID</p> <p id="cId" class="detes"></p>
                        </div>
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">Username</p> <p id="uName" class="detes"></p>
                        </div>
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">Full name</p> <p id="fName" class="detes"></p>
                        </div>
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">email</p> <p id="email" class="detes"></p>
                        </div>
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">Address</p> <p id="address" class="detes"></p>
                        </div>
                    </div>
                    <div id="hiddenViewActions">
                    </div>
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