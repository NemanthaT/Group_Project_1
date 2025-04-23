<?php
include '../../config/config.php';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
    $reason = trim($_POST['reason'] ?? '');

    if ($full_name && $email && $phone_number && $reason) {
        $stmt = $conn->prepare("INSERT INTO contactforums (full_name, email, phone_number, reason) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $full_name, $email, $phone_number, $reason);
        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "Failed to submit your message. Please try again.";
        }
        $stmt->close();
    } else {
        $error = "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy - About Us</title>
    <link rel="stylesheet" href="CU.css">
</head>

<body>
    <!-- Main Content -->
    <main class="contact-main">
        <h1>Contact Us</h1>
        <div class="contact-container">
            <!-- Contact Information Section -->
            <div class="contact-info">
                <h2>Contact Information</h2>
                <p>Say something to start a live chat!</p>
                <ul>
                    <li>0772345678</li>
                    <li>123@gmail.com</li>
                    <li>120 street rd., Galle</li>
                </ul>
            </div>

            <!-- Contact Form Section -->
            <div class="contact-form">
                <?php if ($success): ?>
                    <div class="success-message" style="color: green; margin-bottom: 20px;">
                        Thank you for contacting us! We have received your message.
                    </div>
                <?php elseif ($error): ?>
                    <div class="error-message" style="color: red; margin-bottom: 20px;">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason</label>
                        <textarea id="reason" name="reason" rows="5" required></textarea>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>