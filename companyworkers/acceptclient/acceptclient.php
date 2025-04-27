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
            // Get the username from the form
            $provided_username = isset($_POST['modal_username']) ? trim($_POST['modal_username']) : '';
            $res = mysqli_query($conn, "SELECT * FROM pending_clients WHERE client_id=$client_id");
            if ($row = mysqli_fetch_assoc($res)) {
                $email = $row['email'];
                $password = $row['password'];
                $full_name = $row['full_name'];
                $phone = $row['phone'];
                $address = $row['address'];
                $created_at = $row['created_at'];

                // Accept if email, password, and username are valid
                if (!empty($email) && !empty($password) && !empty($provided_username) &&
                    strtolower((string)$email) !== 'null' &&
                    strtolower((string)$password) !== 'null' &&
                    strtolower((string)$provided_username) !== 'null') {

                    // Escape all fields
                    $provided_username = mysqli_real_escape_string($conn, $provided_username);
                    $email = mysqli_real_escape_string($conn, $email);
                    $password = mysqli_real_escape_string($conn, $password);
                    $full_name = mysqli_real_escape_string($conn, $full_name);
                    $phone = mysqli_real_escape_string($conn, $phone);
                    $address = mysqli_real_escape_string($conn, $address);
                    $created_at = mysqli_real_escape_string($conn, $created_at);

                    // Check for duplicate email or username
                    $dup_query = "SELECT 1 FROM clients WHERE email='$email' OR username='$provided_username'";
                    $dup = mysqli_query($conn, $dup_query);

                    if (mysqli_num_rows($dup) === 0) {
                        // Insert into clients
                        $insert_query = "INSERT INTO clients (username, password, email, full_name, phone, address, created_at)
                                         VALUES ('$provided_username', '$password', '$email', '$full_name', '$phone', '$address', '$created_at')";

                        if (mysqli_query($conn, $insert_query)) {
                            mysqli_query($conn, "DELETE FROM pending_clients WHERE client_id=$client_id");
                            $message = '<div style="color:green;margin-bottom:1em;">Client accepted and added to clients table.</div>';
                        } else {
                            $message = '<div style="color:red;margin-bottom:1em;">Insert failed: ' . mysqli_error($conn) . '</div>';
                        }
                    } else {
                        // Duplicate found
                        $message = '<div style="color:orange;margin-bottom:1em;">Duplicate username or email. Client not added.</div>';
                    }
                } else {
                    // Invalid data
                    $message = '<div style="color:red;margin-bottom:1em;">Invalid client data. Username, email, and password are required.</div>';
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
    <link rel="stylesheet" href="../dashboard/dashboard.css">
</head>
<body>
    <!-- Sidebar -->
    <button class="sidebar-toggle" id="sidebarToggle">
        ☰
    </button>
    
    <!-- Overlay for mobile -->
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
                        <button class="active">
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
                <li><a href="../serviceproviders/view.php">
                    <button >
                    <span class="menu-icon">🛠️</span>
                    Service Providers
                    </button></a>
                </li>
            </ul>
        </div>

    <!-- Header -->
    <div class="main-wrapper">
            <!-- Navbar -->
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
            <h2>Accept Clients</h2>
            <p>View and manage all clients.</p>
            </div>
                <div class="date-time" style="text-align:right;">
                <div id="currentDate"></div>
                <div id="currentTime"></div>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <main class="main">
        <?php echo $message; ?>
        
        <!-- Client Requests Section -->
        <div class="client-section">
            
            <div class="client-grid">
                <?php if (empty($pendingClients)): ?>
                    <div class="client-card">
                        <h3>No pending client requests</h3>
                        <div class="client-info">
                            <p>There are currently no pending client requests to review.</p>
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
                            <h3><?php echo htmlspecialchars($client['full_name'] ?: 'New Client'); ?></h3>
                            <div class="client-info">
                                <p><strong>Username:</strong> <?php echo htmlspecialchars($client['username']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($client['email']); ?></p>
                                <p><strong>Date:</strong> <?php echo htmlspecialchars($client['created_at']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
    
    <!-- Modal Popup -->
    <div class="modal-bg" id="clientModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()" aria-label="Close">&times;</button>
            <form method="post" id="modalForm" autocomplete="off">
                <input type="hidden" name="modal_client_id" id="modal_client_id">
                <h3 id="modal_full_name"></h3>
                <div class="modal-details">
                    <label for="modal_username_input"><strong>Username:</strong></label>
                    <input type="text" name="modal_username" id="modal_username_input" required style="width:100%;margin-bottom:10px;">
                    <p><strong>Email:</strong> <span id="modal_email"></span></p>
                    <p><strong>Phone:</strong> <span id="modal_phone"></span></p>
                    <p><strong>Address:</strong> <span id="modal_address"></span></p>
                    <p><strong>Requested:</strong> <span id="modal_created_at"></span></p>
                </div>
                <div class="modal-actions">
                    <button type="submit" name="modal_action" value="reject" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Reject
                    </button>
                    <button type="submit" name="modal_action" value="accept" class="btn btn-primary">
                        <i class="fas fa-check"></i> Accept
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function showModal(client) {
            document.getElementById('modal_client_id').value = client.client_id;
            document.getElementById('modal_full_name').textContent = client.full_name || 'New Client';
            document.getElementById('modal_username_input').value = client.username || '';
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
            if(e.key === 'Escape' && document.getElementById('clientModal').classList.contains('active')) {
                closeModal();
            }
        });
    </script>
</body>
</html>