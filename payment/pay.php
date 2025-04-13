<?php

    include "../config/config.php"; //connect to database
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: ../Login/login.php"); // Redirect to login page if not logged in
        exit();
    }
    //Get the mail from the session;
    $email = $_SESSION['email'];

    //Get the user details
    $query[0] = "SELECT * FROM clients WHERE email='$email'";
    $result[0] = $conn->$query[0];

    //Get the project details
    $query[1] = "SELECT * FROM projects WHERE project_id = '".$_POST['project_id']."'";
    $result[1] = $conn->$query[1];

    $clRow = $result[0]->fetch_assoc();
    $prRow = $result[1]->fetch_assoc();

    /*$amount = 3000;
    $merchant_id = "1230029";
    $order_id = uniqid();*/

    $merchant_id = "1230029";
    //Project details
    $order_id = $prRow['project_id'];
    $item = $prRow['project_name'];
    $amount = $prRow['amount'];
    $currency = "LKR";
    $merchant_secret = "MzY1NDA3NDEyMjI2NTgxODM1NjI3MDY0MjE2MTMyMDU1NTcyNTQ2";

    //Client details
    $fullname = $clRow['full_name'];
    $email = $clRow['email'];
    $phone = $clRow['phone'];
    $address = $clRow['address'];

    $hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 

    );

    $array = [];

    /*$array['merchant_id'] = $merchant_id;
    $array['order_id'] = $order_id;
    $array['amount'] = $amount;
    $array['currency'] = $currency;
    $array['hash'] = $hash;*/

    $array['merchant_id'] = $merchant_id;
    $array['order_id'] = $order_id;
    $array['item'] = $item;
    $array['amount'] = $amount;
    $array['currency'] = $currency;
    $array['fullname'] = $fullname;
    $array['email'] = $email;
    $array['phone'] = $phone;
    $array['address'] = $address;
    $array['hash'] = $hash;

    $jsonObj = json_encode($array);

?>