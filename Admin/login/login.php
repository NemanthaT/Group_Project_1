<?php 
session_start(); //start session
require_once('../config/config.php'); //include config file

if (isset($_POST['submit'])){ //check if form was submitted

    $Email = $_POST['email']; //get email from form
    $Password = $_POST['password']; //get password from form

    $query_admin = "SELECT * FROM admins WHERE email='$Email'";  //query to get admin details
    $query_companyworkers = "SELECT * FROM companyworkers WHERE email='$Email'";  //query to get company worker details
    $query_clients = "SELECT * FROM clients WHERE email='$Email'";  //query to get client details
    $query_serviceproviders = "SELECT * FROM serviceproviders WHERE email='$Email'";  //query to get service provider details

    //execute query
    $result_log_admin = mysqli_query($conn, $query_admin);
    $result_log_companyworkers = mysqli_query($conn, $query_companyworkers); 
    $result_log_clients = mysqli_query($conn, $query_clients);
    $result_log_serviceproviders = mysqli_query($conn, $query_serviceproviders);

    //fetch data
    $assoc_admin = mysqli_fetch_assoc($result_log_admin);   
    $assoc_companyworkers = mysqli_fetch_assoc($result_log_companyworkers);
    $assoc_clients = mysqli_fetch_assoc($result_log_clients);
    $assoc_serviceproviders = mysqli_fetch_assoc($result_log_serviceproviders);

    //check if email and password match
    if ($assoc_admin['email'] == $Email){ //check if email is in admin table
        if($assoc_admin['password'] == $Password){
            $_SESSION['username'] = $assoc_admin['username'];
            $_SESSION['email'] = $assoc_admin['email'];

            header("Location: ../admin/dashboard/admin.php"); //redirect to admin page
            exit;
        }
        else{
            echo "<script>alert('Login failed!');</script>";
            echo "<script>location.href='login.php';</script>";  
        }      
    }
    elseif ($assoc_companyworkers['email'] == $Email){ //check if email is in company workers table
        if($assoc_companyworkers['password'] == $Password){
            $_SESSION['username'] = $assoc_companyworkers['username'];
            $_SESSION['email'] = $assoc_companyworkers['email'];
    
            header("Location: ../companyworkers/companyworker.php"); //redirect to company worker page
            exit;
        }
        else{
            echo "<script>alert('Login failed!');</script>";
            echo "<script>location.href='login.php';</script>";  
        }      
    }
    elseif ($assoc_clients['email'] == $Email){ //check if email is in clients table
        if($assoc_clients['password'] == $Password){
            $_SESSION['username'] = $assoc_clients['username'];
            $_SESSION['email'] = $assoc_clients['email'];
    
            header("Location: ../clients/client.php"); //redirect to client page
            exit;
        }
        else{
            echo "<script>alert('Login failed!');</script>";
            echo "<script>location.href='login.php';</script>";  
        }      
    }
    elseif ($assoc_serviceproviders['email'] == $Email){ //check if email is in service providers table
        if($assoc_serviceproviders['password'] == $Password){
            $_SESSION['username'] = $assoc_serviceproviders['username'];
            $_SESSION['email'] = $assoc_serviceproviders['email'];
    
            header("Location: ../serviceproviders/serviceprovider.php"); //redirect to service provider page
            exit;
        }
        else{
            echo "<script>alert('Login failed!');</script>"; //display error message
            echo "<script>location.href='login.php';</script>";
        }
    }
    else{
        echo "<script>alert('Login failed!');</script>"; //display error message
        echo "<script>location.href='login.php';</script>";
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
    <div class="blurry-background">

    </div>
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
            <input type="checkbox" onclick="showPassword()">
            <script> function showPassword() {    
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }</script>
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
    <footer >
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
</body>

</html>