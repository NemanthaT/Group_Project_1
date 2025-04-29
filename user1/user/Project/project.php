<?php
include '../session/session.php';
include '../../connect/connect.php';

$clientId = $_SESSION['client_id'];

$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

$sql = "SELECT * FROM projects WHERE client_id = '$clientId' and project_status!='delete'  ";
if ($status_filter != 'all') {
    $sql .= " AND project_status = '$status_filter'";
}
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka - Appointment Management</title>
    <link rel="stylesheet" href="style.css">

    <style>
        
.filter-group select, .search-group input {
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
  min-width: 200px;
}
.reds {
    background-color: red;
}
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
        </div>
        <ul class="menu">
            <li>
                <a href="../Dashboard/Dashboard.php">
                    <button>
                        <img src="../images/dashboard.png" alt="Dashboard">
                        Dashboard
                    </button>
                </a>
            </li>
            <li>
                <a href="../appointments/appointment.php">
                    <button>
                        <img src="../images/appointment.png" alt="Appointment">
                        Appointment
                    </button>
                </a>
            </li>
            <li>
                <a href="../Project/project.php">
                    <button class="active">
                        <img src="../images/project.png" alt="project">
                        Projects
                    </button>
                </a>
            </li>
            <li>
                <a href="../bill/bill.php">
                    <button>
                        <img src="../images/bill.png" alt="Bill">
                        Bill
                    </button>
                </a>
            </li>
            <li>
                <a href="../forum/forum.php">
                    <button>
                        <img src="../images/forum.png" alt="Forum">
                        Forum
                    </button>
                </a>
            </li>
            <li>
                <a href="../Message/Message.php">
                    <button>
                        <img src="../images/Message.png" alt="Message">
                        Message
                    </button>
                </a>
            </li>
        </ul>
    </div>
    <div class="main-wrapper">
        <div class="navbar">
            <a href="#"></a>
            <div class="profile">
                <a href="../profile/profile.php">
                    <img src="../images/user.png" alt="Profile">
                </a>
            </div>
            <a href="../../../Login/Logout.php" class="logout">Logout</a>
        </div>
        <div class=".main-container">
            <div class="space"></div>
            <div class="controls card1">
                <h1>Projects</h1>
            </div>





            <div class="center">
    <form method="get" class="controls">
    <div class="filter-group">
        <?php 
        $status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';
        ?>
        <select id="status-filter" name="status" onchange="this.form.submit()">
        <option value="all" <?php echo $status_filter == 'all' ? 'selected' : ''; ?>>All </option>
        <option value="on-hold" <?php echo $status_filter == 'on-hold' ? 'selected' : ''; ?>>on-hold</option>
        <option value="completed" <?php echo $status_filter == 'completed' ? 'selected' : ''; ?>>completed</option>


    </select>
    </div>

    </form>
</div>











            <div class="project-grid">
                <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="project-card">
                    <div class="project-header">
                        <span class="project-id">P <?php echo htmlspecialchars($row['project_id']); ?></span>
                        <span class="status <?php echo $row['project_status'] === 'Ongoing' ? 'green' : 'red'; ?>">
                            <?php echo htmlspecialchars($row['project_status']); ?>
                        </span>
                    </div>
                    <div class="project-content">
                        <div class="project-info">
                            <h2><strong><?php echo htmlspecialchars($row['project_name']); ?></strong></h2> <br />
                            <p><?php echo htmlspecialchars($row['project_description']); ?></p>
                        </div>
                        <a href="projectview.php?project_id=<?php echo urlencode($row['project_id']); ?>">
                            <button class="pay-button">View</button>
                         </a>


                         <a href=" updatetodelete.php?project_id=<?php echo urlencode($row['project_id']);  ?>">
                         <?php if ($row['project_status']=="completed"): ?>
                                <button class="pay-button reds">Delete</button>
                            <?php endif; ?>
                         </a>

                         
                    </div>
                </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
