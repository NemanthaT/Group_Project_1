<?php
session_start();
require_once('../../../config/config.php');
//include '../../../Error/error.php';

$username = $_SESSION['username'];
$email = $_SESSION['email'];

$_SESSION['nPB'] = 'none';

if (!isset($_SESSION['username'])) { // if not logged in
    header("Location: ../../../login/login.php");
    exit;
}

$sqlR = "SELECT * FROM bills WHERE status = 'paid' ORDER BY paid_on DESC"; // Fetch all records from the bills table
$resultR = $conn->query($sqlR);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="../../css/common.css">
    <link rel="stylesheet" href="reports.css">
    <link rel="stylesheet" href="../../css/preloader.css">
    <link rel="stylesheet" href="../../../Error/error.css">
    <script src="../../../Error/error.js"></script>
    <script src="reports.js"></script>
    <script src="../../js/preloader.js"></script>
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

        <h1>Payments</h1>
        <div class="mainTop">

            <!--Search Reports by client Id-->
            <!--<div class="section">
                    <h2>Search By Client Id</h2>
                    <div class="searchContainer">
                        <form action="" method="POST">
                            <input type="text" name="id" placeholder="Enter Client ID" required>
                            <button class="sBtn" type="submit" name="search_c">Search</button>
                        </form>
                    </div>
                </div>
                
                Search Report by request Id
                <div class="section">
                    <h2>Search By Request Id</h2>
                    <div class="searchContainer">
                        <form action="" method="POST">
                            <input type="text" name="id" placeholder="Enter Request ID" required>
                            <button class="sBtn" type="submit" name="search_r">Search</button>
                        </form>
                    </div>
                </div>-->

            <!--Search By date-->
            <div class="section">
                <h2>Filter By Date</h2>
                <div class="searchContainer">
                    <form action="" method="POST">
                        <input type="date" name="dayB" required>
                        <input type="date" name="dayE" required>
                        <button class="sBtn" type="submit" name="search_d">Search</button>
                    </form>
                </div>
            </div>

            <div id="report">
                <button id="gBtn">Generate</button>
            </div>

        </div>


        <div id="searchResults">
            <?php
            /*if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['search_c'])) {
                        $id = $_POST['id'];
                        if(!is_numeric($id)){
                            $_SESSION['error']="Enter a numeric Value";
                            //echo "<script>alert('Error: Please Enter Numeric Values!');</script>";
                        }
                        else{
                            
                            // Prepare and execute the SQL query
                            $stmt = $conn->prepare("SELECT * FROM payments WHERE client_id = ?");
                            $searchTerm = $id;
                            $stmt->bind_param("s", $searchTerm);
                            $stmt->execute();
                            $result = $stmt->get_result();
                                    
                            // Close the statement
                            $stmt->close();
                            echo "<center><h2>Search Results</h2></center>";
                            echo "<button id=\"closeView\" onclick=\"closeView()\">x</button>";
                            echo "<center><table class=\"displayArea\">";
                                if($result->num_rows > 0){
                                    //create table
                                    echo "<tr>
                                            <th>Client Id</th>
                                            <th>Request Id</th>
                                            <th>Amount</th>
                                            <th>Payment Date</th>
                                        </tr>";
                                    // Output matching results
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["client_id"]. "</td><td>" . $row["service_request_id"]. "</td><td>" . $row["amount"]. "</td><td>". $row["payment_date"]. "</td></tr>";
                                    }
                                } 
                                else{
                                    echo "<tr><td> </td><td> No Result Found </td><td> </td></tr>";
                                }
                            echo "</table></center>";
                            echo "<hr>";
                        }

                    }
                    if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['search_r'])) {
                        $id = $_POST['id'];
                        if(!is_numeric($id)){
                            $_SESSION['error']="Enter a numeric Value";
                            //echo "<script>alert('Error: Please Enter Numeric Values!');</script>";
                        }
                        else{
                            
                            // Prepare and execute the SQL query
                            $stmt = $conn->prepare("SELECT * FROM payments WHERE service_request_id = ?");
                            $searchTerm = $id;
                            $stmt->bind_param("s", $searchTerm);
                            $stmt->execute();
                            $result = $stmt->get_result();
                                    
                            // Close the statement
                            $stmt->close();
                            echo "<center><h2>Search Results</h2></center>";
                            echo "<button id=\"closeView\" onclick=\"closeView()\">x</button>";
                            echo "<center><table class=\"displayArea\">";
                                if($result->num_rows > 0){
                                    //create table
                                    echo "<tr>
                                            <th>Client Id</th>
                                            <th>Request Id</th>
                                            <th>Amount</th>
                                            <th>Payment Date</th>
                                        </tr>";
                                    // Output matching results
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr><td>" . $row["client_id"]. "</td><td>" . $row["service_request_id"]. "</td><td>" . $row["amount"]. "</td><td>". $row["payment_date"]. "</td></tr>";
                                    }
                                } 
                                else{
                                    echo "<tr><td> </td><td><center> No Result Found </center></td><td> </td></tr>";
                                }
                            echo "</table></center>";
                            echo "<hr>";
                        }

                    }*/
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_d'])) {
                $dayB = $_POST['dayB'];
                $dayE = $_POST['dayE'];

                if ($dayB > $dayE) {
                    $_SESSION['error'] = "Enter a Valid Date Range";
                    //echo "<script>alert('Error: Invalid Date Range!');</script>";
                } else {
                    // Prepare and execute the SQL query
                    $stmt = $conn->prepare("SELECT * FROM bills WHERE paid_on BETWEEN ? AND ? ORDER BY paid_on DESC");
                    $stmt->bind_param("ss", $dayB, $dayE);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Close the statement
                    $stmt->close();
                    echo "<center><h2>Search Results</h2></center>";
                    echo "<button id=\"closeView\" onclick=\"closeView()\">x</button>";
                    echo "<center><table class=\"displayArea\">";
                    if ($result->num_rows > 0) {
                        //create table
                        echo "<tr>
                                        <th>Description</th>
                                        <th>Bill Date</th>
                                        <th>Amount</th>
                                        <th>Paid On</th>
                                    </tr>";
                        // Output matching results
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["Description"] . "</td><td>" . $row["Bill_Date"] . "</td><td>Rs." . $row["Amount"] . ".00</td><td>" . $row["paid_on"] . "</td></tr>";
                        }
                    } else {
                        echo "<tr><td> </td><td> No Result Found </td><td> </td></tr>";
                    }
                    echo "</table></center>";
                    echo "<hr>";
                }
            }
            ?>
        </div>
        <div>
            <center>
                <table>
                    <tr>
                        <th>Description</th>
                        <th>Bill Date</th>
                        <th>Amount</th>
                        <th>Paid On</th>
                    </tr>
                    <?php
                    if ($resultR->num_rows > 0) {
                        while ($row = $resultR->fetch_assoc()) {
                            echo "<tr><td>" . $row["Description"] . "</td><td>" . $row["Bill_Date"] . "</td><td>" . $row["Amount"] . "</td><td>" . $row["paid_on"] . "</td></tr>";
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                    ?>
                </table>
            </center>
        </div>
        <?php if (isset($_SESSION['error']) || isset($_SESSION['success'])): ?>
            <div id="popupModal" class="modal">
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    <div class="modal-header">
                        <h2>
                            <?php
                            // Check if it's an error or success message and display the corresponding title
                            if (isset($_SESSION['error'])) {
                                echo '<span class="Error">Error</span>';
                            } elseif (isset($_SESSION['success'])) {
                                echo '<span class="Success">Success</span>';
                            }
                            ?>
                        </h2>
                        <hr>
                    </div>
                    <div class="modal-body">
                        <p>
                            <?php
                            // Directly print the message from the session
                            echo isset($_SESSION['error']) ? htmlspecialchars($_SESSION['error']) : htmlspecialchars($_SESSION['success']);
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            // Unset both error and success messages after displaying them
            unset($_SESSION['error']);
            unset($_SESSION['success']);
            ?>
        <?php endif; ?>
    </div>
</body>

</html>