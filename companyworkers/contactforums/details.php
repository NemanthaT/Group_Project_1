<?php
session_start();
include '../../config/config.php';
include '../../sendemail/send.php'; // Include the sendEmail function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$autoloadPath = '../../vendor/autoload.php';
$composerWarning = '';
if (file_exists($autoloadPath)) {
    require $autoloadPath;
} else {
    $composerWarning = "Warning: Composer autoload file not found at $autoloadPath. Some features may not work. Please run 'composer install' in the project root.";
}

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
    $sql = "SELECT * FROM contactforums WHERE cf_id = $forum_id";
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
    <?php if (!empty($composerWarning)): ?>
        <div style="background: #fff3cd; color: #856404; padding: 10px 20px; border: 1px solid #ffeeba; margin: 20px; border-radius: 5px;">
            <?php echo htmlspecialchars($composerWarning); ?>
        </div>
    <?php endif; ?>
    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">☰</button>
    <div class="overlay" id="overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            
            <ul class="menu">
                <li>
                    <a href="../Dashboard/Dashboard.php">
                        <button >
                        <span class="menu-icon">📊</span>
                            Dashboard
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../servicerequest/servicerequest.php">
                        <button >
                        <span class="menu-icon">🔧</span>
                            Service Requests
                        </button>
                    </a>
                    </li>
                <li>
                    <a href="../acceptclient/acceptclient.php">
                        <button>
                        <span class="menu-icon">👥</span>
                            Client Accept
                        </button>
                    </a>
                </li>                <li>
                    <a href="../contactforums/contactforum.php">
                        <button class="active">
                        <span class="menu-icon">💬</span>
                        Conact Forum
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../updateknowlgebase/initial.php">
                    <button>
                    <span class="menu-icon">📚</span>
                    Update Knowldgebase
                    </button>
                    </a>
                </li>
                <li><a href="../updatenews/initial.php">
                    <button>
                    <span class="menu-icon">📰</span>
                    Update News
                    </button></a>
                </li>
            </ul>
        </div>

    <!-- Header -->
    <div class="main-wrapper">
            <!-- Navbar -->
            <div class="navbar">
                <div class="profile">
                <a href="#">
                    <div class="profile-name"><?php echo htmlspecialchars($fullName); ?></div>
                <img src="../images/user.png" alt="Profile">
                    </a>
                </div>
                <a href="../../Login/Logout.php" class="logout">Logout</a>
            </div>
        

    <div class=".main-container">
        <div class="space"></div>

        <div class="controls card1">
        <div class="welcome-banner">
            <div class="welcome-text">
            <h2>Contact Forums</h2>
            <p>View and manage all contact forum submissions here.</p>
            </div>
                <div class="date-time" style="text-align:right;">
                <div id="currentDate"></div>
                <div id="currentTime"></div>
            </div>
        </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">

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
                    <form id="send_Response" method="post" style="margin-top: 1rem;">
                        <input class="send_Mail" name="sendMail" type="email" value="<?php echo htmlspecialchars($forum['email']); ?>" required>
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
    <script src="send.js"></script>
</body>
</html>
