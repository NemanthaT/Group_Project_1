<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../login.css">
    <link rel="stylesheet" href="forgot.css">
</head>

<body>
    <div class="blurry-background"></div>
    <div class="container">
        <div class="conLeft">
            <center>
                <img class="loginImg" src="forgot.png" alt="login">
            </center>
        </div>
        <div class="conRight">
            <h1>Forgot<br> Password?</h1>
            <p>If you are a registered user, reset link will be sent to your e-mail address.</p>
            <p>Please enter your registered e-mail.</p>
            <form action="login.php" method="post">
                <div>
                    <input type="text" id="email" name="email" placeholder=" &#128231; E-mail" required>
                </div>
                <div class="form-group">
                        <button name="submit" type="submit" style="margin-bottom: 5px">Send Reset Link</button>
                </div>
            </form>
            <center><p class="backLink">&#11164; <a href="../login.php">Back to login</a></p></center>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
</body>

</html>