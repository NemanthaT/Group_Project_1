<?php
    session_start(); 
    require_once('../../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: ../../login/login.php");
        exit;
    }

    // Pagination logic
    $records_per_page = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    // Get total number of records
    $total_records = $conn->query("SELECT COUNT(*) as total FROM providerrequests WHERE status LIKE 'set'")->fetch_assoc()['total'];
    $total_pages = ceil($total_records / $records_per_page);

    // Get paginated data
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
        <link rel="stylesheet" href="requests.css">
        <script src="../../js/common.js"></script>
    </head>

    <body>
        <div class="main">
            <div class="bg">
                    <!--blur Background image-->  
            </div> 

            <div id="overlay" class="overlay"></div>

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
                                <th>Field</th>
                                <th>specialty</th>
                                <th>Action</th>
                            </tr>
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
                        </table>

                        <!-- Pagination links -->
                        <div class="pagination">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
                            <?php endif; ?>
                            
                            <?php 
                                // Show page numbers
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