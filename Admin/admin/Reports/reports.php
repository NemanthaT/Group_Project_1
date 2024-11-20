<?php
    session_start(); 
    require_once('../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: ../../login/login.php");
        exit;
    }

    $sql = "SELECT client_id, service_request_id, amount, payment_date FROM payments";
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reports</title>
        <link rel="stylesheet" href="../../css/common.css">
        <link rel="stylesheet" href="reports.css">
    </head>

    <body>
        <div class="bg">
                <!--blur Background image-->  
        </div> 
        <div>
            <h1>Payments</h1>
            <center>
                <table>
                    <tr>
                        <th>Client Id</th>
                        <th>Request Id</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                    </tr>
                <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["client_id"]. "</td><td>" . $row["service_request_id"]. "</td><td>" . $row["amount"]. "</td><td>". $row["payment_date"]. "</td></tr>";
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