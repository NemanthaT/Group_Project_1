<?php
        
session_start();

require_once ('../config/config.php'); //connect to database

if (isset($_POST['submit'])) { //check if form was submitted

    $Email = $_POST['email']; //get email from form
    $Password = $_POST['password']; //get password from form

    // Define the queries for each user type
    $queries = [
        'admins' => "SELECT * FROM admins WHERE email='$Email'",
        'companyworkers' => "SELECT * FROM companyworkers WHERE email='$Email'",
        'clients' => "SELECT * FROM clients WHERE email='$Email'",
        'serviceproviders' => "SELECT * FROM serviceproviders WHERE email='$Email'"
    ];

    $redirects = [
        'admins' => '../Admin/admin/dashboard/admin.php',
        'companyworkers' => '../companyworkers/dashboard/dashboard.php',
        'clients' => '../user1/user/Dashboard/Dashboard.php',
        'serviceproviders' => '../Service-Provider/SP_Dashboard/SPDash.php'
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
        $_SESSION['userType'] = $userType; // Store user type in session
        // Update last login
        $email = $userData['email'];
        $updateQuery = "UPDATE $userType SET last_login = NOW() WHERE email = '$email'";
        mysqli_query($conn, $updateQuery);

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
        <div class="conLeft">
            <center>
            <img class="loginImg" src="login.png" alt="login">
            </center>
        </div>
        <div class="conRight">
            <form action="login.php" method="post">
                <div class="form-header">
                    <h2>Member Login</h2>
                </div>
                <div class="form-group">
                    <center><input type="text" id="email" name="email" placeholder=" &#128231; E-mail" required></center>
                </div>
                <div class="form-group">
                    <center><input type="password" id="password" name="password" placeholder=" &#128274; Password" required></center>
                </div>
                <div class="showp">
                    <center>
                    <label for="showpassword">Show Password</label>
                    <input type="checkbox" onclick="myFunction()">
                    </center>
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
                    <p>Don't have an account? <a href="Sign_up/switch.php">Sign up</a></p>
                    <p><a href="Forgot/forgot.php">Forgot password?</a></p>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
</body>

</html>
