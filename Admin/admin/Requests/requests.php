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
        <title>Provider Requests</title>       
        <link rel="stylesheet" href="../../css/common.css">
        <link rel="stylesheet" href="requests.css">
    </head>

    <body>
        <div class="main">
            <div class="bg">
                    <!--blur Background image-->  
            </div> 
            <div>
                <h1>Provider Requests</h1>       
                <div id="hiddenView">
                    <button id="closeView" onclick="closeView()">x</button>
                    <center>
                    <table>
                        <tr>
                            <th>Request ID:</th> <td id="reqId"></td>
                        </tr>

                        <tr>
                            <th>Name:</th> <td id="reqName"></td>
                        </tr>

                        <tr>
                            <th><b>Email:</th> <td id="reqEmail"></td>
                        </tr>

                        <tr>
                            <th><b>Tel:</th> <td id="reqTel"></td>
                        </tr>

                        <tr>
                            <th><b>Field:</th> <td id="reqField"></td>
                        </tr>

                        <tr>
                            <th><b>specialty</th> <td id="reqSpec"></td>
                        </tr>
                    </table>
                    </center>
                </div>
                <div id="displayArea">
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
                                        <td class=\"actions\"><center><button class=\"accept\" onclick=\"accReq(" . $row['reqId'] . ")\">Accept</button>
                                        <button class=\"view\" onclick=\"viewReq(" . $row['reqId'] . ")\">View</button>
                                        <button class=\"del\" onclick=\"deleteReq(" . $row['reqId'] . ")\">Delete</button></center></td></tr>";
                                    }
                                }
                                else{
                                    echo "<tr><td></td><td>0 results</td><td></td></tr>";
                                }

                            ?>
                        </table>
                    </center>
                </div>
    
            </div>
        </div>
        
        <script src="requests.js"></script>  
    </body>

</html>