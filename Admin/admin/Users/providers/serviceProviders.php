<?php
    session_start(); 
    require_once('../../../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    $_SESSION['nRSP'] = 'none';

    if (!isset($_SESSION['username'])) { 
        header("Location: ../../../../login/login.php");
        exit;
    }

    $sql = "SELECT * FROM serviceproviders WHERE status = 'set' ORDER BY provider_id DESC";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Service Providers</title>
        <link rel="stylesheet" href="../../../css/common.css">
        <link rel="stylesheet" href="../../../css/preloader.css">
        <link rel="stylesheet" href="../peopleStyles.css">
        <script src="../users.js"></script>
        <script src="../../../js/preloader.js"></script>
    </head>

    <body>
        <div class="main" id="main">
            <div class="bg">
                     
            </div>
            <div id="preloader">
                <div class="spinner"></div>
            </div>
            <div id="popupPreloader">
                <div class="spinner"></div>
            </div>

            <div id="overlay" class="overlay"></div>

            <div>
                <h1>Service Providers</h1>
                <div id="hiddenView">
                    
                    <div id="hiddenViewHeader">
                        <h2>User Details</h2>
                        <button id="closeView" onclick="closeView()">x</button>
                    </div>
                    <div id="userPic">
                        <img src="" alt="User Image">
                    </div>
                    <div id="hiddenViewDetails">
                        <div class="hiddenViewContent">
                            <p id="deteHead">Provider ID</p> <p id="spId" class="detes"></p>
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
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">Specialty</p> <p id="specialty" class="detes"></p>
                        </div>
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">Field</p> <p id="field" class="detes"></p>
                        </div>
                    </div>
                    <div id="hiddenViewActions">
                    </div>
                </div>
                <div id="dropdown" class="dropdown">
                    <p>Filter by: <button id="dBtn" onclick="showDete()">Choose</button></p>
                    <div id="dContent">
                        <ul id="dList">
                            <li><button class="lB" onclick="changeF('Choose')">None</button></li>
                            <li><button class="lB" onclick="changeF('Consultants')">Consultants</button></li>
                            <li><button class="lB" onclick="changeF('Trainers')">Trainers</button></li>
                            <li><button class="lB" onclick="changeF('Researchers')">Researchers</button></li>
                        </ul>
                    </div>
                </div>
                <div id="displayArea">
                    <center>
                        <table id = "dTable">
                            <thead>
                                <tr>
                                    
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Specialty</th>
                                    <th>Actions</th>
                                </tr>                              
                            </thead>
                            <tbody>

                                <?php
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr><!--<td>" . $row["provider_id"]. "</td>--><td>" . $row["username"]. "</td><td>" . $row["email"]. "</td><td>" . $row["speciality"]."</td><td class=\"actions\"><center><button class=\"view\" onclick=\"viewSp(".$row["provider_id"].")\">View</button><button class=\"del\" onclick=\"deleteSp(".$row["provider_id"].")\">Delete</button></center></td></tr>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </center>
                </div>
            </div>
        </div>
    </body>
</html>