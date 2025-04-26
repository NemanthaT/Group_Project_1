<?php
session_start();
require_once('../../../config/config.php');

$username = $_SESSION['username'];
$email = $_SESSION['email'];

if (!isset($_SESSION['username'])) { // if not logged in
    header("Location: ../../../login/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="users.css">
    <link rel="stylesheet" href="../../css/common.css">
</head>

<body>

    <div class="container">
        <div class="form-header">
            <h1>Choose Account Type</h1>
        </div>

        <div class="forms">
            <div class="account-option" onclick="redirectTo('clients/clients.php')">
                <h2>Client</h2>
                <div class="icon-container">👤</div>
            </div>

            <div class="account-option" onclick="redirectTo('providers/serviceProviders.php')">
                <h2>Service Provider</h2>
                <div class="icon-container">🧑‍💼</div>
            </div>
        </div>
    </div>
    </div>
    <script src="../../js/common.js"></script>
</body>

</html>