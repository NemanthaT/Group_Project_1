<?php
session_start();
include '../../config/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../../Login/login.php");
    exit;
}

$username = $_SESSION['username'];
$query = "SELECT full_name FROM companyworkers WHERE username = '" . mysqli_real_escape_string($conn, $username) . "'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
$fullName = $user['full_name'] ?? 'User';

$email = $_SESSION['email'];

if (!isset($_SESSION['username'])) {
    header("Location: ../../Login/Login.php");
    exit;
}

$section = isset($_SESSION['knowledgebase_category']) ? $_SESSION['knowledgebase_category'] : null;

$worker_id = null;
$result_worker = mysqli_query($conn, "SELECT worker_id FROM companyworkers WHERE username = '" . mysqli_real_escape_string($conn, $username) . "'");
if ($row = mysqli_fetch_assoc($result_worker)) {
    $worker_id = $row['worker_id'];
}

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $sql = "INSERT INTO `knowledgebase` (worker_id, section, title, content) VALUES ('$worker_id', '$section', '$title', '$content')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script>alert("Knowledgebase updated");</script>';
    } else {
        echo '<script>alert("Nothing changed");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Knowledge Base Entry | EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../dashboard/dashboard.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="updateknowlgebase.css">
</head>
<body>
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
                        <button >
                        <span class="menu-icon">👥</span>
                            Client Accept
                        </button>
                    </a>
                </li>                <li>
                    <a href="../contactforums/contactforum.php">
                        <button >
                        <span class="menu-icon">💬</span>
                        Contact Forum
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../updateknowlgebase/initial.php">
                    <button class="active">
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
                <li><a href="../serviceproviders/view.php">
                    <button >
                    <span class="menu-icon">🛠️</span>
                    Service Providers
                    </button></a>
                </li>
            </ul>
        </div>

    <div class="main-wrapper">
            <div class="navbar">
                <div class="profile">
                <a href="../myaccount/acc.php">
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
                <h2>Add New Knowledge Base Entry</h2>
                <p>Create a new entry in the knowledge base</p>
            </div>
                <div class="date-time" style="text-align:right;">
                <div id="currentDate"></div>
                <div id="currentTime"></div>
            </div>
        </div>
        </div>
    </div>

    <div class="main-content">

        <div class="dashboard-grid">
            <div class="dashboard-card" style="grid-column: span 2;">
                <form action="" method="POST" class="knowledge-form">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <select id="title" name="title" required>
                            <option value="">Select a title</option>
                            <option value="development finance">Development Finance</option>
                            <option value="micro finance">Micro Finance</option>
                            <option value="organizational development">Organizational Development</option>
                            <option value="sme development">SME Development</option>
                            <option value="gender finance">Gender Finance</option>
                            <option value="institutional development">Institutional Development</option>
                            <option value="community development">Community Development</option>
                            <option value="strategic and operational planning">Strategic and Operational Planning</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea id="content" name="content" placeholder="Enter the content" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="worker_id"></label>
                        <input type="hidden" id="worker_id" name="worker_id" value="<?php echo htmlspecialchars($worker_id); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="section">Section</label>
                        <input type="text" id="section" name="section" value="<?php echo htmlspecialchars($section); ?>" readonly>
                    </div>

                    <div class="form-actions">
                        <button type="submit" name="submit" class="submit-button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

</body>
</html>
