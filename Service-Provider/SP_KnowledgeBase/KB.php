<?php
require_once('../connection.php');

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Create a new case study
        if ($action === 'create') {
            $title = $_POST['title'];
            $description = $_POST['description'];

            // File upload handling
            if (!empty($_FILES['fileUpload']['name'])) {
                $fileName = $_FILES['fileUpload']['name'];
                $fileTmpName = $_FILES['fileUpload']['tmp_name'];
                $uploadDir = '../uploads/';
                $filePath = $uploadDir . basename($fileName);
                move_uploaded_file($fileTmpName, $filePath);
            } else {
                $filePath = null;
            }

            $stmt = $conn->prepare("INSERT INTO researchpapers (provider_id, title, content, published_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iss", $providerId, $title, $description); // Replace $providerId with actual logged-in provider ID
            $stmt->execute();
        }

        // Update an existing case study
        if ($action === 'update') {
            $paperId = $_POST['paper_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];

            $stmt = $conn->prepare("UPDATE researchpapers SET title = ?, content = ? WHERE paper_id = ?");
            $stmt->bind_param("ssi", $title, $description, $paperId);
            $stmt->execute();
        }

        // Delete a case study
        if ($action === 'delete') {
            $paperId = $_POST['paper_id'];

            $stmt = $conn->prepare("DELETE FROM researchpapers WHERE paper_id = ?");
            $stmt->bind_param("i", $paperId);
            $stmt->execute();
        }
    }
}

// Fetch all published case studies
$result = $conn->query("SELECT * FROM researchpapers ORDER BY published_at DESC");
$caseStudies = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="KB.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            <ul class="menu">
                <li><a href="#"><button><img src="../images/dashboard.jpg">Dashboard</button></a></li>
                <li><a href="#"><button><img src="../images/appointment.png">Appointment</button></a></li>
                <li><a href="#"><button><img src="../images/message.jpg">Message</button></a></li>
                <li><a href="#"><button><img src="../images/forum.png">Forum</button></a></li>
                <li><a href="#"><button><img src="../images/knowledgebase.png">KnowledgeBase</button></a></li>
            </ul>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-wrapper">
            <!-- Navbar -->
            <header>
                <nav class="navbar">
                    <a href="#">Home</a>
                    <div class="notification">
                        <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
                    </div>
                    <div class="profile">
                        <a href="#"><img src="../images/user.png" alt="Profile"></a>
                    </div>
                    <a href="#" class="logout">Logout</a>
                </nav>
            </header>

            <!-- Main Content -->
            <div class="main-content">
                <h2>Case Studies and Knowledge Resources</h2>

                <!-- Form for Adding Case Studies -->
                <div class="case-study-form">
                    <h3>Create a New Case Study</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="create">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" placeholder="Enter case study title" required>

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="5" placeholder="Enter case study description" required></textarea>

                        <label for="fileUpload">Upload File:</label>
                        <input type="file" id="fileUpload" name="fileUpload" accept=".pdf,.docx,.txt">

                        <button type="submit">Create Case Study</button>
                    </form>
                </div>

                <!-- Published Case Studies Section -->
                <div class="published-case-studies">
                    <h3>Published Case Studies</h3>
                    <?php foreach ($caseStudies as $case): ?>
                        <div class="case-study-card">
                            <h4><?php echo htmlspecialchars($case['title']); ?></h4>
                            <p><?php echo htmlspecialchars($case['content']); ?></p>
                            <small>Published on: <?php echo htmlspecialchars($case['published_at']); ?></small>
                            <div class="case-study-buttons">
                                <form method="POST" action="View.php" style="display:inline;">
                                    <input type="hidden" name="paper_id" value="<?php echo $case['paper_id']; ?>">
                                    <button type="submit" class="view-btn">View</button>
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="paper_id" value="<?php echo $case['paper_id']; ?>">
                                    <button type="submit" class="update-btn">Update</button>
                                </form>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="paper_id" value="<?php echo $case['paper_id']; ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Footer -->
            <footer>
                <div class="Fcontainer">
                    <!-- Quick Links -->
                    <div class="Fquick-links">
                        <h3>Quick Links</h3>
                        <ul>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Knowledge Base</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">News</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Community</a></li>
                        </ul>
                    </div>
                    <!-- Contact Info -->
                    <div class="Fcontact-info">
                        <h3>Contact Us</h3>
                        <ul>
                            <li>Email: info@edsalanka.com</li>
                            <li>Phone: +94 123 456 789</li>
                            <li>Address: 123 EDSA Lane, Colombo, Sri Lanka</li>
                        </ul>
                        <!-- Social Media Links -->
                        <div class="Fsocial-media">
                            <a href="#"><img src="../images/facebook.jpg" alt="Facebook"></a>
                            <a href="#"><img src="../images/linkedin.png" alt="LinkedIn"></a>
                            <a href="#"><img src="../images/instagram.jpg" alt="Instagram"></a>
                        </div>
                    </div>
                    <!-- Footer Logo -->
                    <div class="Flogo">
                        <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
                    </div>
                </div>
                <div class="Fcopyright">
                    &copy; 2024 EDSA Lanka Consultancy. All rights reserved.
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
