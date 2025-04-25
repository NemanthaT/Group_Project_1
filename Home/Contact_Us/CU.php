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
    <title>EDSA Lanka Consultancy - Contact Us</title>
    <link rel="stylesheet" href="CU.css">
</head>

<body>
    <main class="contact-main">
        <h1>Get in Touch</h1>
        <div class="contact-container">
            <div class="contact-info">
                <h2>Contact Information</h2>
                <p>We'd love to hear from you. Please fill out the form or reach us using our contact information.</p>
                <ul>
                    <li class="phone">+94 77 234 5678</li>
                    <li class="email">info@edsalanka.com</li>
                    <li class="location">120 Street Road, Galle, Sri Lanka</li>
                </ul>
            </div>

            <div class="contact-form">
                <?php if ($success): ?>
                    <div class="success-message">
                        Thank you for contacting us! We'll get back to you soon.
                    </div>
                <?php elseif ($error): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <form action="" method="post">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>
                    </div>
                    <div class="form-group">
                        <label for="reason">How can we help you?</label>
                        <textarea id="reason" name="reason" rows="4" placeholder="Tell us about your inquiry" required></textarea>
                    </div>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>