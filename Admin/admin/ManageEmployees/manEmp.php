<?php
    session_start(); 
    require_once('../../config/config.php');

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $result = null;

    // Get the search input from the form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];

        // Prepare and execute the SQL query
        $stmt = $conn->prepare("SELECT worker_id, full_name, email FROM companyworkers WHERE full_name LIKE ?");
        $searchTerm = "%" . $name . "%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        // Close the statement
        $stmt->close();
    }    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Search</title>
    <link rel="stylesheet" href="../Users/people.css">
    <link rel="stylesheet" href="mngEmp.css">
</head>
<body>
    <h1>Search Employees</h1>
    <div class="search">
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Enter a name" required>
            <button type="submit">Search</button>
        </form>
    </div>
    <div id="results">
        <table>
            <tr>
                <th>UId</th>
                <th>Username</th>
                <th>Email</th>
            </tr>
            <?php
                if($result->num_rows > 0){
                        // Output matching results
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr><td>'.$row['worker_id'] .'</td><td>'. $row['full_name'] . '</td><td>'.$row['email'].'</td></tr>';
                    }
                } 
                else{
                    echo '<tr><td> </td><td> No Result Found </td><td> </td></tr>';
                }
            ?>

        </table>
    </div>
</body>
</html>