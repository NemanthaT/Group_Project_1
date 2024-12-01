<?php
    session_start(); 
    require_once('../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: ../../login/login.php");
        exit;
    }

    $sql = "SELECT provider_id, username, email, speciality FROM serviceproviders";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Service Providers</title>
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
                <h1>Service Providers</h1>
                <div id="hiddenView">
                    <button id="closeView" onclick="closeView()">x</button>
                    <center>
                    <table>
                        <tr><th class="c_th">Provider ID:</th> <td id="spId"></td></tr>
                        <tr><th class="c_th">Username:</th> <td id="uName"></td></tr>
                        <tr><th class="c_th">Full Name:</th> <td id="fName"></td></tr>
                        <tr><th class="c_th">email:</th><td id="email"></td></tr>
                        <tr><th class="c_th">Address:</th><td id="address"></td></tr>
                        <tr><th class="c_th">Specialty:</th><td id="specialty"></td></tr>
                        <tr><th class="c_th">Field:</th><td id="field"></td></tr>
                    </table>
                    </center>
                    
                </div>
                <center>
                    <table>
                        <tr>
                            <!--<th>UId</th>-->
                            <th>Username</th>
                            <th>Email</th>
                            <th>Specialty</th>
                            <th>Actions</th>
                        </tr>
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
                    </table>
                </center>
            </div>
        </div>
    </body>
</html>