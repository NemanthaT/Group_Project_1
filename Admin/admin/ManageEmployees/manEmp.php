<?php
    session_start(); 
    require_once('../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employees</title>
    <link rel="stylesheet" href="../Users/people.css">
    <link rel="stylesheet" href="mngEmp.css">
</head>
<body>
    <h1>Manage Employees</h1>

    <!--Search Employees and list them-->
    <h2>Search Employees</h2>
    <div class="top">
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Enter Name" required>
            <button type="submit" name="search_name">Search</button>
        </form>
    </div>
    <div id="searchResults">
        <table>

            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['search_name'])) {
                    $name = $_POST['name'];
            
                    // Prepare and execute the SQL query
                    $stmt = $conn->prepare("SELECT worker_id, full_name, email FROM companyworkers WHERE full_name LIKE ?");
                    $searchTerm = "%" . $name . "%";
                    $stmt->bind_param("s", $searchTerm);
                    $stmt->execute();
                    $result = $stmt->get_result();
            
                    // Close the statement
                    $stmt->close();
                    if($result->num_rows > 0){
                        //create table
                        echo "<tr>
                                <th>UId</th>
                                <th>Username</th>
                                <th>Email</th>
                              </tr>";
                        // Output matching results
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr><td>'.$row['worker_id'] .'</td><td>'. $row['full_name'] . '</td><td>'.$row['email'].'</td></tr>';
                        }
                    } 
                    else{
                        echo '<tr><td> </td><td> No Result Found </td><td> </td></tr>';
                    }
                }  

            ?>

        </table>
    </div>

    <!--Remove Employees-->
    <h2>Remove Employees</h2>
    <div class="top">
        <form action="" method="POST">
            <input type="text" name="id" placeholder="Enter ID" required>
            <button type="submit" name="remove">Remove</button>
        </form>
    </div>
    <div class="removeEmployee">
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
                $id = $_POST['id'];
                $srch="SELECT * FROM companyworkers WHERE worker_id = $id ";
                $result = $conn->query($srch);

                //checking whether worker exists or not
                if ($result->num_rows > 0) {
                    //Removing the worker
                    $del = "DELETE FROM companyworkers WHERE worker_id = $id";
                    $opert = $conn->query($srch);
                    if ($opert===true) {
                        echo "<p>Record deleted successfully</p>";
                    } else {
                        echo "<p>Error: ".$conn->error."</p>";
                    }
                } else {
                    echo "<p>Error: No records</p>";
                }
            }
        ?>        
    </div>

    <!--Change role of the Employees-->
    <h2>Change Role</h2>
    <div class="top">
        <form action="" method="POST">
            <input type="text" name="id" placeholder="Enter ID" required>
            <input type="text" name="role" placeholder="Enter New Role" required>
            <button type="submit" name="change">Change</button>
        </form>
    </div>
        <div class="changeEmployeeRole">
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change'])) {
                $id = $_POST['id'];
                $role = $_POST['role'];
                $srch="SELECT * FROM companyworkers WHERE worker_id = $id ";
                $result = $conn->query($srch);

                //checking whether worker exists or not
                if ($result->num_rows > 0) {
                    //Changing the role
                    $chng = "UPDATE companyworkers SET role = " . " ' " . $role . " ' " . " WHERE worker_id = $id";
                    $opert = $conn->query($chng);
                    if ($opert===true) {
                        echo "<p>Role changed successfully</p>";
                    } else {
                        echo "<p>Error: ".$conn->error."</p>";
                    }
                } else {
                    echo "<p>Error: No records</p>";
                }
            }
        ?>        
    </div>
</body>
</html>