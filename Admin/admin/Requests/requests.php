<?php
    session_start(); 
    require_once('../../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    $_SESSION['pR'] = 'none';

    if (!isset($_SESSION['username'])) {
        header("Location: ../../../login/login.php");
        exit;
    }

    $records_per_page = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records = $conn->query("SELECT COUNT(*) as total FROM providerrequests WHERE status LIKE 'set'")->fetch_assoc()['total'];
    $total_pages = ceil($total_records / $records_per_page);

    $sql = "SELECT * FROM providerrequests WHERE status LIKE 'set' ORDER BY reqId DESC LIMIT $offset, $records_per_page";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Provider Requests</title>       
        <link rel="stylesheet" href="../../css/common.css">
        <link rel="stylesheet" href="../../css/preloader.css">
        <link rel="stylesheet" href="requests.css">
        <script src="../../js/common.js"></script>
        <script src="../../js/preloader.js"></script>
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
                <h1>Provider Requests</h1>       
                <div id="hiddenView">

                    <div id="hiddenViewHeader">
                        <h2>Request Details</h2>
                        <button id="closeView" onclick="closeView()">x</button>
                    </div>
                    <div id="hiddenViewDetails">
                        <div class="hiddenViewContent">
                            <p id="deteHead">Request ID</p> <p id="reqId" class="detes"></p>
                        </div>
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">Name</p> <p id="reqName" class="detes"></p>
                        </div>
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">Email</p> <p id="reqEmail" class="detes"></p>
                        </div>
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">Tel</p> <p id="reqTel" class="detes"></p>
                        </div>
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">Field</p> <p id="reqField" class="detes"></p>
                        </div>
                        <hr>
                        <div class="hiddenViewContent">
                            <p id="deteHead">Specialty</p> <p id="reqSpec" class="detes"></p>
                        </div>
                    </div>
                    <div id="hiddenViewActions">

                    </div>
                </div>
                <div id="displayArea">
                    <center>
                        <table>
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>specialty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr><td>".$row["field"]."</td><td>".$row["specialty"]."</td>
                                            <td class=\"actions\"><center><button class=\"accept\" onclick=\"accReq(" . $row['reqId'] . ")\">Accept</button>
                                            <button class=\"view\" onclick=\"viewReq(" . $row['reqId'] . ")\">View</button>
                                            <button class=\"del\" onclick=\"deleteReq(" . $row['reqId'] . ")\">Delete</button></center></td></tr>";
                                        }
                                    }
                                    else{
                                        echo "<tr><td></td><td>0 results</td><td></td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>

                        <div class="pagination">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
                            <?php endif; ?>
                            
                            <?php 
                                for ($i = 1; $i <= $total_pages; $i++):
                            ?>
                                <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>>
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>
                            
                            <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
                            <?php endif; ?>
                        </div>
                    </center>
                </div>
    
            </div>
        </div>
        
        <script src="requests.js"></script>  
    </body>
</html>
