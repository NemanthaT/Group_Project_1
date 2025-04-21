<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Send Email</title>
        <link rel="stylesheet" href="../Admin/css/common.css">
    </head>
    <body>
        <form class="" action="send.php" method="post">
            Email: <input type="email" name="email" required><br>
            Subject: <input type="text" name="subject" required><br>
            Message: <input type="text" name="message" required></textarea><br>
            <button type="submit" name="send">Send</button>
        </form>
    </body>
</html>    