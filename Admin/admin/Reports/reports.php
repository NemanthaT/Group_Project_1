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

// Pagination logic
$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Get total number of records
$total_records = $conn->query("SELECT COUNT(*) as total FROM bills")->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);

// Get paginated data
$sqlR = "SELECT Description, Bill_Date, Amount, DATE(paid_on) AS paid_on FROM bills WHERE status = 'paid' ORDER BY paid_on DESC LIMIT $offset, $records_per_page";
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
                    <form action="" method="POST" id="searchForm">
                        <input type="date" name="dayB" required>
                        <input type="date" name="dayE" required>
                        <button class="sBtn" type="submit" name="search_d">Search</button>
                    </form>
                </div>
            </div>

        </div>

        <div id="middleSection">
            <button id="gBtn">Generate</button>

            <select name="status" id="filterS">
                <option value="paid">Paid Bills</option>
                <option value="unpaid">Unpaid Bills</option>
            </select>
        </div>


        <div id="searchResults">

        </div>
        <div>
        <center>
            <table id="mainT">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Bill Date</th>
                        <th>Amount</th>
                        <th>Paid On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultR->num_rows > 0) {
                        while ($row = $resultR->fetch_assoc()) {
                            echo "<tr><td>" . $row["Description"] . "</td><td>" . $row["Bill_Date"] . "</td><td>Rs." . $row["Amount"] . ".00</td><td>" . $row["paid_on"] . "</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 results</td></tr>";
                    }
                    ?>
                </tbody>
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