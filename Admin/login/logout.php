<?php
    ob_start();
    session_start();
    require_once('../config/config.php');

    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
    ob_end_flush();
?>