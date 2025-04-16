<?php
session_start();
include '../../config/config.php'; // Database connection

// Fetch the logged-in user's name
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT full_name FROM companyworkers WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    $fullName = $user['full_name'] ?? 'User';
} else {
    header("Location: ../../Login/login.php");
    exit;
}

// Feedback message
$message = '';

// Handle Accept/Reject Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['modal_action']) && isset($_POST['modal_client_id'])) {
        $client_id = intval($_POST['modal_client_id']);
        if ($_POST['modal_action'] === 'accept') {
            $res = mysqli_query($conn, "SELECT * FROM pending_clients WHERE client_id=$client_id");
            if ($row = mysqli_fetch_assoc($res)) {
                $pending_username = $row['username'];
                $email = $row['email'];
                $password = $row['password'];
                $full_name = $row['full_name'];
                $phone = $row['phone'];
                $address = $row['address'];
                $created_at = $row['created_at'];

                if (!empty($pending_username) && !empty($email) && !empty($password) &&
                    strtolower((string)$pending_username) !== 'null' &&
                    strtolower((string)$email) !== 'null' &&
                    strtolower((string)$password) !== 'null') {

                    // Prevent duplicate email or username
                    $pending_username = mysqli_real_escape_string($conn, $pending_username);
                    $email = mysqli_real_escape_string($conn, $email);
                    $dup = mysqli_query($conn, "SELECT 1 FROM clients WHERE username='$pending_username' OR email='$email' LIMIT 1");

                    if (mysqli_num_rows($dup) === 0) {
                        // Escape other fields
                        $full_name = mysqli_real_escape_string($conn, $full_name);
                        $password = mysqli_real_escape_string($conn, $password);
                        $phone = mysqli_real_escape_string($conn, $phone);
                        $address = mysqli_real_escape_string($conn, $address);
                        $created_at = mysqli_real_escape_string($conn, $created_at);

                        // Insert into clients
                        $insert_query = "INSERT INTO clients (username, password, email, full_name, phone, address, created_at)
                                         VALUES ('$pending_username', '$password', '$email', '$full_name', '$phone', '$address', '$created_at')";

                        if (mysqli_query($conn, $insert_query)) {
                            mysqli_query($conn, "DELETE FROM pending_clients WHERE client_id=$client_id");
                            $message = '<div style="color:green;margin-bottom:1em;">Client accepted and added to clients table.</div>';
                        } else {
                            $message = '<div style="color:red;margin-bottom:1em;">Insert failed: ' . mysqli_error($conn) . '</div>';
                        }
                    } else {
                        // Duplicate found
                        mysqli_query($conn, "DELETE FROM pending_clients WHERE client_id=$client_id");
                        $message = '<div style="color:orange;margin-bottom:1em;">Duplicate username or email. Client not added, but removed from pending list.</div>';
                    }
                } else {
                    // Invalid data
                    mysqli_query($conn, "DELETE FROM pending_clients WHERE client_id=$client_id");
                    $message = '<div style="color:red;margin-bottom:1em;">Invalid client data. Client not added, but removed from pending list.</div>';
                }
            }
        } elseif ($_POST['modal_action'] === 'reject') {
            mysqli_query($conn, "UPDATE pending_clients SET status='rejected' WHERE client_id=$client_id");
            $message = '<div style="color:orange;margin-bottom:1em;">Client rejected.</div>';
        }
    }
}

// Fetch pending clients
$pendingClients = [];
$res = mysqli_query($conn, "SELECT * FROM pending_clients WHERE status='pending' ORDER BY created_at DESC");
while ($row = mysqli_fetch_assoc($res)) {
    $pendingClients[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accept Clients | EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../sidebar.css">
    <link rel="stylesheet" href="acceptclient.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="main-header">
            <div class="logo-section">
                <img src="../images/logo.png" alt="EDSA Lanka Logo">
                <h1>EDSA Lanka Consultancy</h1>
            </div>
            <div class="header-right">
                <img src="../images/notification.png" alt="Notifications" class="notification-icon">
                <img src="../images/user.png" alt="Profile" class="profile-icon">
                <a href="../../Login/Logout.php" class="logout-btn">Logout</a>
            </div>
        </header>

        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Logo">
            </div>
            <ul class="menu">
                <li>
                    <a href="../dashboard/dashboard.php">
                        <button>
                            <img src="../images/dashboard.png" alt="Dashboard">
                            Dashboard
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../acceptclient/acceptclient.php">
                        <button class="active">
                            <img src="../images/dashboard.png" alt="Accept Clients">
                            Accept Clients
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../servicerequest/servicerequest.php">
                        <button>
                            <img src="../images/service.jpg" alt="Service Requests">
                            Service Requests
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../contactforums/contactforum.html">
                        <button>
                            <img src="../images/contact forms.jpg" alt="Contact Forums">
                            Contact Forums
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../updateevents/updateevents.php">
                        <button>
                            <img src="../images/events.jpg" alt="Update Events">
                            Update Events
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../updateknowlgebase/initial.php">
                        <button>
                            <img src="../images/knowlegdebase.jpg" alt="Knowledge Base">
                            Knowledge Base
                        </button>
                    </a>
                </li>
                <li>
                    <a href="../updatenews/initial.php">
                        <button>
                            <img src="../images/news.jpg" alt="Update News">
                            Update News
                        </button>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="main-wrapper">
            <div class="main-container">
                <?php echo $message; ?>
                <div class="controls card1">
                    <h1><i class="fas fa-user-check"></i> Accept Clients</h1>
                    <h3>Welcome Back, <span class="highlight"><?php echo htmlspecialchars($fullName); ?></span>!</h3>
                </div>
                
                <section class="dashboard-container">
                    <!-- Statistics Grid -->
                    <div class="client-grid">
                        <div class="stat-card pending-requests">
                            <div class="card-icon">
                                <i class="fas fa-users-cog pulse"></i>
                            </div>
                            <div class="card-content">
                                <h3>Pending Requests</h3>
                                <p class="card-date">
                                    <i class="far fa-calendar-alt"></i> Today
                                </p>
                                <div class="counter-display">
                                    <div class="digit">5</div>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card accepted">
                            <div class="card-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="card-content">
                                <h3>Accepted Today</h3>
                                <p class="card-date">
                                    <i class="far fa-calendar-alt"></i> Today
                                </p>
                                <div class="counter-display">
                                    <div class="digit">3</div>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card rejected">
                            <div class="card-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="card-content">
                                <h3>Rejected Today</h3>
                                <p class="card-date">
                                    <i class="far fa-calendar-alt"></i> Today
                                </p>
                                <div class="counter-display">
                                    <div class="digit">2</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Client Requests Section -->
                    <div class="client-requests-section">
                        <div class="section-header">
                            <h2><i class="fas fa-user-clock"></i> Client Requests</h2>
                            <div class="filters">
                                <select class="filter-select">
                                    <option value="all">All Requests</option>
                                    <option value="recent">Most Recent</option>
                                    <option value="urgent">Urgent</option>
                                    <option value="pending">Pending</option>
                                </select>
                                <input type="search" 
                                       placeholder="Search by name, email, or project..." 
                                       class="search-input">
                            </div>
                        </div>
                        
                        <div class="client-list">
                            <div class="client-grid">
                            <?php if (empty($pendingClients)): ?>
                                <div class="client-card">
                                    <div class="client-info">
                                        <h3>No pending client requests.</h3>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php foreach ($pendingClients as $client): ?>
                                    <div class="client-card" tabindex="0"
                                        onclick="showModal(<?php echo htmlspecialchars(json_encode([
                                            'client_id' => $client['client_id'],
                                            'username' => $client['username'],
                                            'email' => $client['email'],
                                            'full_name' => $client['full_name'],
                                            'phone' => $client['phone'],
                                            'address' => $client['address'],
                                            'created_at' => $client['created_at']
                                        ])); ?>)"
                                        onkeydown="if(event.key==='Enter'){showModal(<?php echo htmlspecialchars(json_encode([
                                            'client_id' => $client['client_id'],
                                            'username' => $client['username'],
                                            'email' => $client['email'],
                                            'full_name' => $client['full_name'],
                                            'phone' => $client['phone'],
                                            'address' => $client['address'],
                                            'created_at' => $client['created_at']
                                        ])); ?>)}"
                                    >
                                        <div class="client-info">
                                            <p><strong>Username:</strong> <?php echo htmlspecialchars($client['username']); ?></p>
                                            <p><strong>Email:</strong> <?php echo htmlspecialchars($client['email']); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Modal Popup -->
    <div class="modal-bg" id="clientModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()" aria-label="Close">&times;</button>
            <form method="post" id="modalForm" autocomplete="off">
                <input type="hidden" name="modal_client_id" id="modal_client_id">
                <h3 id="modal_full_name"></h3>
                <div class="modal-details">
                    <p><strong>Username:</strong> <span id="modal_username"></span></p>
                    <p><strong>Email:</strong> <span id="modal_email"></span></p>
                    <p><strong>Phone:</strong> <span id="modal_phone"></span></p>
                    <p><strong>Address:</strong> <span id="modal_address"></span></p>
                    <p><strong>Requested:</strong> <span id="modal_created_at"></span></p>
                </div>
                <div class="modal-actions">
                    <button type="submit" name="modal_action" value="accept" class="btn btn-primary">
                        <i class="fas fa-check"></i> Accept
                    </button>
                    <button type="submit" name="modal_action" value="reject" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Reject
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function showModal(client) {
            document.getElementById('modal_client_id').value = client.client_id;
            document.getElementById('modal_full_name').textContent = client.full_name || '';
            document.getElementById('modal_username').textContent = client.username || '';
            document.getElementById('modal_email').textContent = client.email || '';
            document.getElementById('modal_phone').textContent = client.phone || '';
            document.getElementById('modal_address').textContent = client.address || '';
            document.getElementById('modal_created_at').textContent = client.created_at || '';
            document.getElementById('clientModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        function closeModal() {
            document.getElementById('clientModal').classList.remove('active');
            document.body.style.overflow = '';
        }
        document.getElementById('clientModal').addEventListener('click', function(e){
            if(e.target === this) closeModal();
        });
        document.addEventListener('keydown', function(e){
            if(e.key === "Escape") closeModal();
        });
    </script>
</body>
</html>