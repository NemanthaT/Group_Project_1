<?php
    session_start(); 
    require_once('../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    if (!isset($_SESSION['username'])) { // if not logged in
        header("Location: ../../login/login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees</title>
    <link rel="stylesheet" href="../../css/common.css">
    <link rel="stylesheet" href="empStyles.css">
    <script src="emp.js"></script>
</head>
<body>
    <div class="bg">
        <!--blur Background image-->  
    </div>
    <div id="addEmp">
        <button id="closeView" onclick="closeForm()">x</button>
        <div id="addEmpForm">
            <center>
                <form action="" method="POST">
                    <label for="fullname">Full Name:</label>
                    <input type="text" name="fullname" placeholder="Enter Full Name" required><br>
                    <label for="username">Username:</label>
                    <input type="text" name="username" placeholder="Enter Username" required><br>
                    <label for="role">Role:</label>
                    <input type="text" name="role" placeholder="Enter Role" required><br>
                    <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="Enter Email" required><br>
                    <center><button type="submit" name="addEmp">Add</button></center>
                </form>
            </center>
        </div>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addEmp'])) {
                $username = $_POST['username'];
                $fullname = $_POST['fullname'];
                $role = $_POST['role'];
                $email = $_POST['email'];
                $password = rand(100000, 999999);
                $password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO companyworkers (username, full_name, role, email, password) VALUES ('$username', '$fullname', '$role', '$email', '$password')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('New Employee Added Successfully!');</script>";
                } else {
                    echo "<script>alert('Error: ".$conn->error."!');</script>";
                }
            }
        ?>
    </div>
    
    <div class="main" id="main">
        <h1>Manage Employees</h1>
        <div class ="mainTop">
            <!--Search Employees and list them-->
            <div class="section">
                <h2>Search</h2>
                <div class="searchContainer">
                    <form action="" method="POST">
                        <input type="text" name="name" placeholder="Enter Name" required>
                        <button class="sBtn" type="submit" name="search_name">Search</button>
                    </form>
                </div>
            </div>
            
            <!--Remove Employees-->
            <div class="section">
                <h2>Remove Employees</h2>
                <div class="searchContainer">
                    <form action="" method="POST">
                        <input type="text" name="id" placeholder="Enter ID" required>
                        <button class="rBtn" type="submit" name="remove">Remove</button>
                    </form>
                </div>
                <div class="removeEmployee">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
                            $id = $_POST['id'];
                            //check whether given id is an integer
                            if (!is_numeric($id)) {
                                echo "<script>alert('Error: Invalid ID!');</script>";
                            }
                            else{
                                $srch="SELECT * FROM companyworkers WHERE worker_id = $id ";
                                $result = $conn->query($srch);
    
                                //checking whether worker exists or not
                                if ($result->num_rows > 0) {
                                    //Removing the worker
                                    $del = "DELETE FROM companyworkers WHERE worker_id = $id";
                                    $opert = $conn->query($del);
                                    if ($opert===true) {
                                        echo "<script>alert('Employee Deleted!');</script>";  
                                    }
                                    else {
                                        echo "<script>alert('Error: ".$conn->error."!');</script>";
                                    }
                                } else {
                                    echo "<script>alert('Error: Invalid ID!');</script>";
                                }
                            }
                        }
                    ?>        
                </div>
            </div>

            
            <!--Change role of the Employees-->
            <div class="section">
                <h2>Change Role</h2>
                <div class="searchContainer">
                    <form action="" method="POST">
                        <input type="text" name="id" placeholder="Enter ID" required>
                        <input type="text" name="role" placeholder="Enter New Role" required>
                        <button class="chBtn" type="submit" name="change">Change</button>
                    </form>
                </div>
                    <div class="changeEmployeeRole">
                    <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change'])) {
                            $id = $_POST['id'];
                            if (!is_numeric($id)) {
                                echo "<script>alert('Error: Invalid ID!');</script>";
                            }
                            else{
                                $role = $_POST['role'];
                                $srch="SELECT * FROM companyworkers WHERE worker_id = $id ";
                                $result = $conn->query($srch);
    
                                //checking whether worker exists or not
                                if ($result->num_rows > 0) {
                                    //Changing the role
                                    $chng = "UPDATE companyworkers SET role = " . " ' " . $role . " ' " . " WHERE worker_id = $id";
                                    $opert = $conn->query($chng);
                                    if ($opert===true) {
                                        echo "<script>alert('Role Changed Successfully!');</script>"; ;
                                    } else {
                                        echo "<script>alert('Error: ".$conn->error."!');</script>";
                                    }
                                } else {
                                    echo "<script>alert('>Error: Invalid ID!');</script>";
                                }
                            }
                        }
                    ?>        
                </div>

            </div>

        </div>
        <div id="form">
            <button id="addEmpBtn" onclick="showForm()">Add Employee</button>
        </div>
        <div id="searchResults">
            <div id="results">
                <?php

                    if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['search_name'])) {
                        $name = $_POST['name'];
                
                        // Prepare and execute the SQL query
                        $stmt = $conn->prepare("SELECT * FROM companyworkers WHERE full_name LIKE ?");
                        $searchTerm = "%" . $name . "%";
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
                                    <th>UId</th>
                                    <th>User Name</th>
                                    <th>Full Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                </tr>";
                            // Output matching results
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr><td>'.$row['worker_id'] .'</td><td>'. $row['username'] .'</td><td>'. $row['full_name'] . '</td><td>'.$row['role'].'</td><td>'.$row['email'].'</td></tr>';
                            }
                        } 
                    else{
                            echo '<tr><td> </td><td> No Result Found </td><td> </td></tr>';
                    }
                    echo "</table></center>";
                    echo "<hr>";
                    }   

                ?>
            </div>
            
            <!--List all the Employees-->
            <div>
                <?php
                    echo "<center><table class=\"displayArea\">
                    <tr>
                        <th>UId</th>
                        <th>User Name</th>
                        <th>Full Name</th>
                        <th>Role</th>
                        <th>Email</th>
                    </tr>";

                    $sql = "SELECT * FROM companyworkers";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<tr><td>'.$row['worker_id'] .'</td><td>'. $row['username'] .'</td><td>'. $row['full_name'] . '</td><td>'.$row['role'].'</td><td>'.$row['email'].'</td></tr>';
                        }
                    } else {
                        echo "0 results";
                    }


                    echo "</table></center>";
                ?>
            </div>
        </div>
    </div>
</body>
</html>