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
        <link rel="stylesheet" href="peopleStyles.css">
        <link rel="stylesheet" href="../../css/common.css">
    </head>

    <body>
        <div class="bg">
                <!--blur Background image-->  
        </div> 
        <div>
            <h1>Service Providers</h1>
            <center>
                <table>
                    <tr>
                        <th>UId</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Speciality</th>
                    </tr>
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["provider_id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["email"]. "</td><td>" . $row["speciality"]."</td></tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                ?>
                </table>
            </center>
        </div>
    </body>
</html>