<?php
session_start();
include '../../config/config.php';
include '../../sendemail/send.php'; // Include the sendEmail function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../vendor/autoload.php'; // Adjust path if needed

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../Login/login.php");
    exit;
}

// Get user details
$username = $_SESSION['username'];
$query = "SELECT full_name FROM companyworkers WHERE username = '" . mysqli_real_escape_string($conn, $username) . "'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$fullName = $user['full_name'] ?? 'User';

// Get contact forum details from contactforums table
if (isset($_GET['id'])) {
    $forum_id = intval($_GET['id']);
    $sql = "SELECT * FROM contactforums WHERE id = $forum_id";
    $result = mysqli_query($conn, $sql);
    $forum = mysqli_fetch_assoc($result);

    if (!$forum) {
        header("Location: contactforum.php");
        exit;
    }
} else {
    header("Location: contactforum.php");
    exit;
}

// Handle response form submission
$responseSuccess = false;
$responseError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['response_message'])) {
    $responseMessage = trim($_POST['response_message']);
    $to = $forum['email'];
    $subject = "Response to your Contact Forum Submission";
    $body = "Dear " . $forum['full_name'] . ",<br><br>";
    $body .= nl2br(htmlspecialchars($responseMessage)) . "<br><br>";
    $body .= "Best regards,<br>EDSA Lanka Consultancy";

    if (!empty($responseMessage)) {
        // Prepare data for sendEmail
        $data = [
            'email' => $to,
            'subject' => $subject,
            'message' => $body
        ];
        // Capture output buffer to check for success/failure
        ob_start();
        sendEmail($data);
        $output = ob_get_clean();
        if (strpos($output, 'Email sent successfully!') !== false) {
            $responseSuccess = true;
        } else {
            $responseError = "Failed to send the email. Please try again.";
        }
    } else {
        $responseError = "Response message cannot be empty.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Forum Details</title>
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="details.css">
    <link rel="stylesheet" href="../dashboard/dashboard.css">

</head>
<body>
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">☰</button>
    <div class="overlay" id="overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div style="width: 40px; height: 40px; background-color: #4f46e5; display: flex; align-items: center; justify-content: center; color: white; border-radius: 5px; margin-right: 15px;">E</div>
            <span>EDSA Lanka</span>
        </div>
        <div class="sidebar-menu">
            <a href="../dashboard/dashboard.php">
                <div class="menu-item">
                    <span class="menu-icon">📊</span>
                    <span>Dashboard</span>
                </div>
            </a>
            <a href="../servicerequest/servicerequest.php">
                <div class="menu-item">
                    <span class="menu-icon">🔧</span>
                    <span>Service Requests</span>
                </div>
            </a>
            <a href="../acceptclient/acceptclient.php">
                <div class="menu-item">
                    <span class="menu-icon">👥</span>
                    <span>Accept Clients</span>
                </div>
            </a>
            <a href="contactforum.php">
                <div class="menu-item active">
                    <span class="menu-icon">📝</span>
                    <span>Contact Forums</span>
                </div>
            </a>
            <a href="../updateknowlgebase/initial.php">
                <div class="menu-item">
                    <span class="menu-icon">📚</span>
                    <span>Update Knowledge Base</span>
                </div>
            </a>
            <a href="../updatenews/initial.php">
                <div class="menu-item">
                    <span class="menu-icon">📰</span>
                    <span>Update News</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Header -->
    <header>
        <div class="logo-text">EDSA Lanka Consultancy</div>
        <div class="user-area">
            <div class="notification">
                🔔
                <span class="notification-count">3</span>
            </div>
            <div class="user-profile">
                <div style="width: 40px; height: 40px; background-color: #64748b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                    <?php echo strtoupper(substr($fullName, 0, 1)); ?>
                </div>
                <span><?php echo htmlspecialchars($fullName); ?></span>
            </div>
            <form action="../../Login/Logout.php" method="post" style="display:inline;">
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <div class="welcome-banner">
            <div class="welcome-text">
                <h2>Contact Forum Details</h2>
                <p>View complete information about this contact forum submission.</p>
            </div>
        </div>

        <div class="details-container">
            <div class="details-header">
                <div class="meta-grid">
                    <div class="meta-item">
                        <span class="meta-label">Date Submitted</span>
                        <span class="meta-value"><?php echo date('F j, Y g:i A', strtotime($forum['created_at'])); ?></span>
                    </div>
                </div>
            </div>

            <div class="details-content">
                <section class="info-section">
                    <h3>Contact Information</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Full Name</span>
                            <span class="info-value"><?php echo htmlspecialchars($forum['full_name']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span>
                            <span class="info-value"><?php echo htmlspecialchars($forum['email']); ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone Number</span>
                            <span class="info-value"><?php echo htmlspecialchars($forum['phone_number']); ?></span>
                        </div>
                    </div>
                </section>

                <div class="divider"></div>

                <section class="message-section">
                    <h3>Message</h3>
                    <div class="content-box">
                        <div class="content-item">
                            <div class="message-box">
                                <?php echo nl2br(htmlspecialchars($forum['reason'])); ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Respond to Message Form -->
                <section class="message-section">
                    <h3>Respond to User</h3>
                    <?php if ($responseSuccess): ?>
                        <div style="color: green; margin-bottom: 1rem;">Response sent successfully to <?php echo htmlspecialchars($forum['email']); ?>.</div>
                    <?php elseif ($responseError): ?>
                        <div style="color: red; margin-bottom: 1rem;"><?php echo htmlspecialchars($responseError); ?></div>
                    <?php endif; ?>
                    <form method="post" style="margin-top: 1rem;">
                        <textarea name="response_message" rows="6" style="width:100%;padding:1rem;border-radius:8px;border:1px solid #e5e7eb;font-size:1rem;" placeholder="Type your response here..." required><?php echo isset($_POST['response_message']) ? htmlspecialchars($_POST['response_message']) : ''; ?></textarea>
                        <button type="submit" class="back-button" style="margin-top:1rem;">Send Response</button>
                    </form>
                </section>
            </div>

            <div class="actions">
                <a href="contactforum.php" class="back-button">
                    <span class="icon">←</span>
                    Back to Contact Forums
                </a>
            </div>
        </div>
    </div>

    <script src="../sidebar.js"></script>
</body>
</html>
