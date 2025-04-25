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

// Fetch case study details
$modalCase = null;
if (isset($_GET['paper_id'])) {
    $paperId = $_GET['paper_id'];
    $stmt = $conn->prepare("SELECT * FROM researchpapers WHERE paper_id = ? AND provider_id = ?");
    $stmt->bind_param("ii", $paperId, $providerId);
    $stmt->execute();
    $result = $stmt->get_result();
    $modalCase = $result->fetch_assoc();
    $stmt->close();
}

if (!$modalCase) {
    echo "Case study not found.";
    exit;
}

// Handle case study update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'update') {
        $paperId = $_POST['paper_id'];
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        $stmt = $conn->prepare("UPDATE researchpapers SET title = ?, content = ? WHERE paper_id = ? AND provider_id = ?");
        $stmt->bind_param("ssii", $title, $description, $paperId, $providerId);
        $stmt->execute();
        header("Location: KB.php");
        exit;
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

                <h2>View Case Study</h2>
                
                <div class="case-study-form">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="paper_id" id="paper_id" value="<?php echo $modalCase['paper_id']; ?>">

                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($modalCase['title']); ?>" readonly>

                        <label for="description">Description:</label>
                        <textarea id="description" name="description" rows="5" readonly><?php echo htmlspecialchars($modalCase['content']); ?></textarea>

                        <button type="button" onclick="toggleEdit()">Edit</button>
                        <button type="submit">Update Case Study</button>
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