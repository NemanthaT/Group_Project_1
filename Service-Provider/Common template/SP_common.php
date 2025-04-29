<?php
include '../connection.php';

if (!isset($_SESSION['provider_id'])) {
    header("Location: ../login.php");
    exit();
}

$provider_id = $_SESSION['provider_id'];
$sql = "SELECT username, profile_image FROM serviceproviders WHERE provider_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $provider_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $common_provider = $result->fetch_assoc();
} else {
    $common_provider = [
        'username' => 'Unknown',
        'profile_image' => '../images/user.png'
    ];
}

$stmt->close();
?>
<div class="container">
    <div class="sidebar">
        <div class="logo">
            <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
        </div>
        <ul class="menu">
            <li><a href="../SP_Dashboard/SPDash.php"><button><img src="../images/dashboard.png">Dashboard</button></a></li>
            <li><a href="../SP_Appointment/App.php"><button><img src="../images/appointment.png">Appointment</button></a></li>
            <li><a href="../SP_Message/Message.php"><button><img src="../images/message.png">Message</button></a></li>
            <li><a href="../SP_Projects/Project.php"><button><img src="../images/project.png">Project</button></a></li>
            <li><a href="../SP_Bill/Bill.php"><button><img src="../images/bill.png">Bill</button></a></li>
            <li><a href="../SP_Forum/Forum.php"><button><img src="../images/forum.png">Forum</button></a></li>
            <li><a href="../SP_KnowledgeBase/KB.php"><button><img src="../images/knowledgebase.png">KnowledgeBase</button></a></li>
        </ul>
    </div>       
  
    <header>
        <nav class="navbar">
            <div class="profile">
                <a href="../SP_Profile/Profile.php">
                    <img src="<?php echo htmlspecialchars($common_provider['profile_image'] ?: '../images/user.png'); ?>" alt="Profile">
                    <span class="username">Hi, <?php echo htmlspecialchars($common_provider['username']); ?></span>
                </a>
            </div>
            
            <a href="../../Login/Logout.php" class="logout">Logout</a>                
        </nav>
    </header>