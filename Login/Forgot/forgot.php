<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../login.css">
</head>

<body>
    <div class="blurry-background"></div>
    <div class="container">
        <form action="login.php" method="post">
            <div class="form-header">
                <h2>Forgot Password</h2>
            </div>
            <div>
                <p style="margin: 5px 10px 10px 10px">If you are a registered user an e-mail will be sent your e-mail address.</p>
            </div>
            <div class="form-group1">
                <label for="email">e-mail:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <center>
                    <button name="submit" type="submit" style="margin-bottom: 5px">Send</button>
                </center>
            </div>
        </form>
    </div>
    <footer>
        <p>&copy; 2024 EDSA Lanka Consultancy</p>
    </footer>
</body>

</html>
