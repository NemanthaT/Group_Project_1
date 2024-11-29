<?php
        
session_start();

include '../config/config.php'; //connect to database

if (isset($_POST['submit'])) { //check if form was submitted

    $Email = $_POST['email']; //get email from form
    $Password = $_POST['password']; //get password from form

    // Define the queries for each user type
    $queries = [
        'admin' => "SELECT * FROM admins WHERE email='$Email'",
        'companyworker' => "SELECT * FROM companyworkers WHERE email='$Email'",
        'client' => "SELECT * FROM clients WHERE email='$Email'",
        'serviceprovider' => "SELECT * FROM serviceproviders WHERE email='$Email'"
    ];

    $redirects = [
        'admin' => '../Admin/admin/dashboard/admin.php',
        'companyworker' => '../companyworkers/dashboard/dashboard.html',
        'client' => '../user1/user/Dashboard/Dashboard.php',
        'serviceprovider' => '../Service-Provider/SP_Dashboard/SP_Dash.html'
    ];

    $userType = null;
    $userData = null;

    // Loop through each query to find a matching user
    foreach ($queries as $type => $query) {
        $result = mysqli_query($conn, $query);

        if ($result && $row = mysqli_fetch_assoc($result)) {
            if ($row['password'] === $Password) { // Validate password
                $userType = $type;
                $userData = $row;
                break;
            } else {
                echo "<script>alert('Invalid password!');</script>";
                echo "<script>window.location = 'login.php';</script>";
                exit;
            }
        }
    }

    // If a user is found, set session and redirect
    if ($userType && $userData) {
        $_SESSION['username'] = $userData['username'];
        $_SESSION['email'] = $userData['email'];

        header("Location: " . $redirects[$userType]);
        exit;
    } else {
        echo "<script>alert('Email not found!');</script>";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="blurry-background"></div>
    <div class="container">
        <form action="login.php" method="post">
            <div class="form-header">
                <h2>Login</h2>
            </div>
            <div class="form-group1">
                <label for="email">e-mail:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group2">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="showp">
                <label for="showpassword">Show Password</label>
                <input type="checkbox" onclick="myFunction()">
                <script>
                    function myFunction() {
                        var x = document.getElementById("password");
                        if (x.type === "password") {
                            x.type = "text";
                        } else {
                            x.type = "password";
                        }
                    }
                </script>
            </div>
            <div class="form-group">
                <center>
                    <button name="submit" type="submit">Login</button>
                </center>
            </div>
            <div class="form-footer">
                <p>Don't have an account? <a href="#">Sign up</a></p>
                <p><a href="#">Forgot password?</a></p>
            </div>
        </form>
    </div>
    <footer>
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
</body>

</html>
