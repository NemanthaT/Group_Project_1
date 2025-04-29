<?php
session_start();
require_once('../../../config/config.php');

$username = $_SESSION['username'];
$email = $_SESSION['email'];
if (!isset($_SESSION['username'])) {
    header("Location: ../../../login/login.php");
    exit;
}
$afDiv = "mainContent";

$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

$total_records = $conn->query("SELECT COUNT(*) as total FROM companyworkers WHERE status = 'set'")->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);

$sql = "SELECT worker_id, full_name, email, role FROM companyworkers WHERE status = 'set' LIMIT $offset, $records_per_page";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees</title>
    <link rel="stylesheet" href="../../css/common.css">
    <link rel="stylesheet" href="../../css/preloader.css">
    <link rel="stylesheet" href="empStyles.css">
    <script src="../../js/common.js"></script>
    <script src="../../js/preloader.js"></script>
    <script src="emp.js"></script>
</head>

<body>
    <div class="bg"></div>

    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <div id="popupPreloader">
        <div class="spinner"></div>
    </div>

    <div id="overlay" class="overlay"></div>

    <div id="errorView">
        <button id="closeError" onclick="closeError('mainContent')">x</button>
        <h2>Hello</h2>
        <hr>
        <p>MF</p>
    </div>

    <div class="main" id="main">
        <h1>Manage Employees</h1>

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
                    <p id="deteHead">Emp ID</p>
                    <p id="cId" class="detes"></p>
                </div>
                <hr>
                <div class="hiddenViewContent">
                    <p id="deteHead">Username</p>
                    <p id="uName" class="detes"></p>
                </div>
                <hr>
                <div class="hiddenViewContent">
                    <p id="deteHead">Full name</p>
                    <p id="fName" class="detes"></p>
                </div>
                <hr>
                <div class="hiddenViewContent">
                    <p id="deteHead">email</p>
                    <p id="email" class="detes"></p>
                </div>
                <hr>
                <div class="hiddenViewContent">
                    <p id="deteHead">Role</p>
                    <p id="role" class="detes"></p>
                </div>
                <hr>
                <div class="hiddenViewContent">
                    <p id="deteHead">Address</p>
                    <p id="address" class="detes"></p>
                </div>
            </div>
            <div id="hiddenViewActions">
            </div>
        </div>

        <div id="addEmp">
            <button id="closeView" onclick="closeForm()">✕</button>
            <div id="addEmpForm">
                <form action="" method="POST" id="fm">
                    <label for="fullname">Full Name:</label><br>
                    <input type="text" name="fullname" placeholder="Enter Full Name" required><br>
                    <label for="username">Username:</label><br>
                    <input type="text" name="username" placeholder="Enter Username" required><br>
                    <label for="role">Role:</label><br>
                    <input type="text" name="role" placeholder="Enter Role" required><br>
                    <label for="address">Address:</label><br>
                    <input type="text" name="address" placeholder="Enter Address" required><br>
                    <label for="phoneNo">Phone No:</label><br>
                    <input type="text" name="phoneNo" placeholder="Enter Phone Number" required><br>
                    <label for="email">Email:</label><br>
                    <input type="email" name="email" placeholder="Enter Email" required><br>
                    <center><button type="submit" name="addEmp" class="sBtn">Add</button></center>
                </form>
            </div>
        </div>

        <div id="mainContent">
            <div class="mainTop">
                <div class="section">
                    <h2>Search</h2>
                    <div class="searchContainer">
                        <form action="" method="POST" id="searchForm">
                            <input type="text" name="name" placeholder="Enter Name" required>
                            <button class="sBtn" type="submit" name="search_name">Search</button>
                        </form>
                    </div>
                </div>
                <!--
                <div class="section">
                    <h2>Remove Employees</h2>
                    <div class="searchContainer">
                        <form action="" method="POST" id="removeForm">
                            <input type="text" name="id" placeholder="Enter ID" required>
                            <button class="rBtn" type="submit" name="remove">Remove</button>
                        </form>
                    </div>
                    <div class="removeEmployee"></div>
                </div>

                <div class="section">
                    <h2>Change Role</h2>
                    <div class="searchContainer">
                        <form action="" method="POST" id="changeForm">
                            <input type="text" name="id" placeholder="Enter ID" required>
                            <input type="text" name="role" placeholder="Enter New Role" required>
                            <button class="chBtn" type="submit" name="change">Change</button>
                        </form>
                    </div>
                    <div class="changeEmployeeRole"></div>
                </div>-->
            </div>

            <div id="form">
                <button id="addEmpBtn" onclick="showForm()">Add Employee</button>
            </div>

            <div id="searchResults">
                <div id="results">
                    <center>
                        <h2>Search Results</h2>
                    </center>
                    <button id="closeView" onclick="closeView()">x</button>
                    <center>
                        <table class="displayArea" id="displayArea">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </center>
                </div>

                <div id="dA">
                    <?php
                    echo "<center><table class=\"displayArea\">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>   
                        </tr>
                        </thead>
                        <tbody>";

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr><td>' . $row['full_name'] . '</td><td>' . $row['email'] . '</td><td>' . $row['role'] . '</td><td><center><button class="view" onclick="findW('. $row['worker_id'] .')">View</button></center></td></tr>';
                        }
                    } else {
                        echo "<tr><td colspan='5'>0 results</td></tr>";
                    }

                    echo "</tbody> </table>";

                    echo '<div class="pagination">';
                    if ($page > 1) {
                        echo '<a href="?page=' . ($page - 1) . '">&laquo; Previous</a>';
                    }

                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo '<a href="?page=' . $i . '"' . ($i == $page ? ' class="active"' : '') . '>' . $i . '</a>';
                    }

                    if ($page < $total_pages) {
                        echo '<a href="?page=' . ($page + 1) . '">Next &raquo;</a>';
                    }
                    echo '</div></center>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>