<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'nemanthatharusha@gmail.com'; // SMTP username
    $mail->Password = 'bjhzwtcijimyaijm'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port = 587; // TCP port to connect to

    $mail->setFrom('nemanthatharusha@gmail.com');

    $mail->addAddress($_POST["email"]); // Add a recipient
    //$mail->addReplyTo(''); // Add a reply-to address
    $mail->Subject = $_POST["subject"]; // Subject
    $mail->Body = $_POST["message"]; // Message body

    try {
        $mail->send(); // Send the email
        echo 
        "<script>
            alert('Email sent successfully!');
            document.location.href = 'index.php';
        </script>"
        ;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}