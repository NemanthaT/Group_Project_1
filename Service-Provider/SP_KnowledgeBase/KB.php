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

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Delete a case study
        if ($action === 'delete') {
            $paperId = $_POST['paper_id'];

            $stmt = $conn->prepare("DELETE FROM researchpapers WHERE paper_id = ? AND provider_id = ?");
            $stmt->bind_param("ii", $paperId, $providerId);
            $stmt->execute();
        }

        // Redirect back to avoid form resubmission issues
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Fetch all published case studies for the logged-in provider
$stmt = $conn->prepare("SELECT * FROM researchpapers WHERE provider_id = ? ORDER BY published_at DESC");
$stmt->bind_param("i", $providerId);
$stmt->execute();
$result = $stmt->get_result();
$caseStudies = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
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
                <h2>Case Studies and Knowledge Resources</h2>
                    <div class="filter-group search-group">
                    <input type="text" id="searchInput" placeholder="Search case studies..." oninput="searchCaseStudies()">
                        <!-- <button class="search-button" id="searchButton" onclick="searchCaseStudies()">Search</button> -->
                        <button class="clear-button" id="clearButton" onclick="clearSearch()">Clear</button>
                        <a href="createKB.php" class="create-btn"><button class="search-button">Create Case Study</button></a>
                    </div>

                    <div class="published-case-studies-container">
                    <?php foreach ($caseStudies as $case): ?>
                        <div class="case-study-card" id="case-<?php echo $case['paper_id']; ?>">
                            <h4><?php echo htmlspecialchars($case['title']); ?></h4>
                            <div class="case-study-buttons">
                                <a href="ViewKB.php?paper_id=<?php echo $case['paper_id']; ?>" class="view-btn">View</a>
                                    <form method="POST" style="display:inline;" onsubmit="return confirmDelete(<?php echo $case['paper_id']; ?>);">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="paper_id" value="<?php echo $case['paper_id']; ?>">
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
            </div>
        </div>
    </div>   <!--this is the </div> of container in the common file, don't remove it-->
<script src="KB.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>