<?php

    include "../config/config.php"; //connect to database
    session_start();
    
    //Get the mail from the session;
    $email = $_SESSION['email'];

    //Get the user details
    $query[0] = "SELECT * FROM clients WHERE email='$email'";
    $result[0] = $conn->query($query[0]);

    //Get the bill details
    if (!isset($_GET['id'])) {
        echo json_encode(["error" => "Bill ID not passed."]);
        exit;
    }
    $bill_id = $_GET['id'];
    $query[1] = "SELECT * FROM bills WHERE bill_id ='$bill_id'";
    $result[1] = $conn->query($query[1]);

    $clRow = $result[0]->fetch_assoc();
    $bRow = $result[1]->fetch_assoc();

    //get the project details
    $project_id = $bRow['project_id'];
    $query[2] = "SELECT * FROM projects WHERE project_id ='$project_id'";
    $result[2] = $conn->query($query[2]);

    $prRow = $result[2]->fetch_assoc();

    /*$amount = 3000;
    $merchant_id = "1230029";
    $order_id = uniqid();*/

    $merchant_id = "1230029";
    //Project details
    $order_id = $bill_id;
    $item = $bRow['Description'];
    $amount = $bRow['Amount'];
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

    echo $jsonObj;

?>