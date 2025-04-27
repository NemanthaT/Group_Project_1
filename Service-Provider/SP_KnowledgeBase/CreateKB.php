<?php 
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

// Check if provider is logged in
if (!isset($_SESSION['provider_id'])) {
    echo "Unauthorized. Please log in.";
    exit;
}

$providerId = $_SESSION['provider_id']; // Logged-in provider's ID

// Handle case study creation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        $title = $_POST['title'];
        $description = $_POST['description'];

        // File upload handling
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filePath = null;
        if (!empty($_FILES['fileUpload']['name'])) {
            $fileName = uniqid() . '_' . basename($_FILES['fileUpload']['name']);
            $fileTmpName = $_FILES['fileUpload']['tmp_name'];
            $filePath = $uploadDir . $fileName;
            if (move_uploaded_file($fileTmpName, $filePath)) {
                echo "File uploaded successfully: " . htmlspecialchars($filePath);
            } else {
                echo "Error uploading file.";
            }
        }

        // Ensure providerId and other fields are valid
        if (!empty($providerId) && !empty($title) && !empty($description)) {
            $stmt = $conn->prepare("INSERT INTO researchpapers (provider_id, title, content, published_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("iss", $providerId, $title, $description);
            $stmt->execute();
            header("Location: KB.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="KB.css">
</head>
<body>
        <div class="main-content">
            <div class="KB-section">
                <div class="back-link">
                    <a href="KB.php">← Back to Case Studies</a>
                </div>

                <h2>Create Case Study</h2>
                
                <div class="case-study-form">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="create">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" placeholder="Enter case study title" required>

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="15" placeholder="Enter case study description" required></textarea>

                        <label for="fileUpload">Upload File:</label>
                        <input type="file" id="fileUpload" name="fileUpload" accept=".pdf,.docx,.txt">

                        <button type="submit">Create Case Study</button>
                        <a href="KB.php" class="cancel-btn">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>   <!--this is the </div> of container in the common file, don't remove it-->
<script src="KB.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>