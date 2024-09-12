<?php

$localserver="localhost";
$user = "root";
$password="";
$dbname="edsalanka";


    $conn = new mysqli($localserver,$user,$password,$dbname);

    if ($conn->connect_error) {
        echo"connection not succesfull";
        die($conn->connect_error);
       

    }else{
        echo"connection ----succesfull";
    }
?>