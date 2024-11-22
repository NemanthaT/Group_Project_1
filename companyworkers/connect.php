<?php
$con = mysqli_connect("localhost","root","","edsalanka.sql");

if($con){
    echo "connected";
}
else{
    echo "not connected";
}

?>