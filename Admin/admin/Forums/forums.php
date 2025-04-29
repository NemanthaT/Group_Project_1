<?php
    session_start(); 
    require_once('../../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    $_SESSION['nF'] = 'none';

    if (!isset($_SESSION['username'])) {
        header("Location: ../../../login/login.php");
        exit;
    }

    $records_per_page = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    $total_records = $conn->query("SELECT COUNT(*) as total FROM forums")->fetch_assoc()['total'];
    $total_pages = ceil($total_records / $records_per_page);

    $sql = "SELECT * FROM forums ORDER BY forum_id DESC LIMIT $offset, $records_per_page";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Clients</title>
        <link rel="stylesheet" href="../../css/common.css">
        <link rel="stylesheet" href="../../css/preloader.css">
        <script src="../../js/preloader.js"></script>
        <link rel="stylesheet" href="forums.css">  
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
                <h1>Manage Forums</h1>
    
                <div id="hiddenView">

                    <div id="hiddenViewHeader">
                        <h2>Forum Details</h2>
                        <button id="closeView" onclick="closeView()">x</button>
                    </div>
                    
                    <center>
                    
                        <p class="forum_th" id="forumId"></p>
                        <p class="forum_th" id="forumTitle"></p>
                        <p class="forum_th" id="createdBy"></p>
                        <p class="forum_th" id="createdAt"></p>
                        <p class="forum_th" id="clientId" style="display: none;"></p>
                        <p class="forum_th">Content:</p>
                        <p class="content" id="forumContent"></p>
                    
                    </center>
                    
                </div>
    
                <div id="displayArea">
                    <center>
                        <table>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr><td>".$row["title"]."</td>
                                            <td class=\"actions\"><center><button class=\"view\" onclick=\"viewForum(" . $row['forum_id'] . ")\">View</button>
                                            <button class=\"del\" onclick=\"deleteForum(" . $row['forum_id'] . ")\">Delete</button></center></td></tr>";
                                        }
                                    }
                                    else{
                                        echo "<tr><td></td><td><center>0 results</center></td><td></td></tr>";
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
        <script src="../../js/common.js"></script>
        <script src="forums.js"></script>
    </body>
</html>
