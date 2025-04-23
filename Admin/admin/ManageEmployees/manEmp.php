<?php
    session_start(); 
    require_once('../../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: ../../../login/login.php");
        exit;
    }
    $afDiv = "mainContent";

    // Pagination logic
    $records_per_page = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    // Get total number of records
    $total_records = $conn->query("SELECT COUNT(*) as total FROM companyworkers WHERE status = 'set'")->fetch_assoc()['total'];
    $total_pages = ceil($total_records / $records_per_page);

    // Get paginated data
    $sql = "SELECT * FROM companyworkers WHERE status = 'set' LIMIT $offset, $records_per_page";
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
    <div class="bg">
        <!--blur Background image-->  
    </div>

    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!--Overlay-->
    <div id="overlay" class="overlay"></div>
    
    <!--Error message {-->
    <div id="errorView">
        <button id="closeError" onclick="closeError('mainContent')">x</button>
            
                <h2>Hello</h2>
                <hr>                
                <p>MF</p>
            
                    
    </div>
    <!--}Error message -->

    <div class="main" id="main">
        <h1>Manage Employees</h1>

        <!--Add Employee Form-->
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
        <!--End of Add Employee Form-->


        <div id="mainContent">
            <div class ="mainTop">
                <!--Search Employees and list them-->
                <div class="section">
                    <h2>Search</h2>
                    <div class="searchContainer">
                        <form action="" method="POST" id="searchForm">
                            <input type="text" name="name" placeholder="Enter Name" required>
                            <button class="sBtn" type="submit" name="search_name">Search</button>
                        </form>
                    </div>
                </div>
                
                <!--Remove Employees-->
                <div class="section">
                    <h2>Remove Employees</h2>
                    <div class="searchContainer">
                        <form action="" method="POST" id="removeForm">
                            <input type="text" name="id" placeholder="Enter ID" required>
                            <button class="rBtn" type="submit" name="remove">Remove</button>
                        </form>
                    </div>
                    <div class="removeEmployee">        
                    </div>
                </div>

                
                <!--Change role of the Employees-->
                <div class="section">
                    <h2>Change Role</h2>
                    <div class="searchContainer">
                        <form action="" method="POST" id="changeForm">
                            <input type="text" name="id" placeholder="Enter ID" required>
                            <input type="text" name="role" placeholder="Enter New Role" required>
                            <button class="chBtn" type="submit" name="change">Change</button>
                        </form>
                    </div>
                        <div class="changeEmployeeRole">        
                    </div>

                </div>

            </div>

            <!--Button for adding new employees-->
            <div id="form">
                <button id="addEmpBtn" onclick="showForm()">Add Employee</button>
            </div>
            <!--Button for adding new employees-->

            <!--Employee details-->
            <div id="searchResults">
                <div id="results">
                    <center><h2>Search Results</h2></center>
                    <button id="closeView" onclick="closeView()">x</button>
                    <center>
                        <table class="displayArea" id="displayArea">
                            <thead>
                                <tr>
                                    <th>UId</th>
                                    <th>User Name</th>
                                    <th>Full Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- The search results will be populated here -->
                            </tbody>
                        </table>
                    </center>
                </div>
                
                <!--List all the Employees-->
                <div id="dA">
                    <?php
                        echo "<center><table class=\"displayArea\">
                        <tr>
                            <th>UId</th>
                            <th>User Name</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Email</th>
                        </tr>";

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<tr><td>'.$row['worker_id'] .'</td><td>'. $row['username'] .'</td><td>'. $row['full_name'] . '</td><td>'.$row['role'].'</td><td>'.$row['email'].'</td></tr>';
                            }
                        } else {
                            echo "<tr><td colspan='5'>0 results</td></tr>";
                        }

                        echo "</table>";

                        // Pagination links
                        echo '<div class="pagination">';
                        if ($page > 1) {
                            echo '<a href="?page='.($page - 1).'">&laquo; Previous</a>';
                        }
                        
                        for ($i = 1; $i <= $total_pages; $i++) {
                            echo '<a href="?page='.$i.'"'.($i == $page ? ' class="active"' : '').'>'.$i.'</a>';
                        }
                        
                        if ($page < $total_pages) {
                            echo '<a href="?page='.($page + 1).'">Next &raquo;</a>';
                        }
                        echo '</div></center>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>