<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    require 'envLoader.php';
    loadEnv(__DIR__ . '/.env'); // Load environment variables from .env file

    //$data = json_decode(file_get_contents("php://input"), true);

    // Check if the request method is POST and the data is set
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data'])) {
        $data = json_decode($_POST['data'], true);
        if ($data) {
            sendEmail($data);
        } else {
            echo json_encode(["error" => "Invalid data format"]);
        }
    }

    function sendEmail($data) {
        
        $mail = new PHPMailer(true);

        $email = $data['email'];
        $subject = $data['subject'];
        $message = $data['message'];


        $mail->isSMTP();

        $mail->Host = getenv('SMTP_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USERNAME');
        $mail->Password = getenv('SMTP_PASSWORD');
        $mail->SMTPSecure = 'tls';
        $mail->Port = getenv('SMTP_PORT');


        $mail->setFrom('edsalankapvtltd@gmail.com');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $message;
        $mail->AltBody = strip_tags($message);

        try {
            $mail->send();

            $notMessage = "Email sent successfully!";
            $notMessage = str_replace("'", "\'", $notMessage); // Escape single quotes for JavaScript
            echo "<script>
                console.log(" . json_encode($notMessage) . ");
            </script>";
        } catch (Exception $e) {
            $notMessage = "Email didn't send!";
            $notMessage = str_replace("'", "\'", $notMessage); // Escape single quotes for JavaScript
            echo "<script>
                console.log(" . json_encode($notMessage) . ");
                console.log(" . json_encode($email) . ");
                console.log(" . json_encode($subject) . ");
                console.log(" . json_encode($message) . ");
            </script>";
        }
    }
?>