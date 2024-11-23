<?php
require_once('../connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['paper_id'])) {
        $paperId = $_POST['paper_id'];

        $stmt = $conn->prepare("SELECT * FROM researchpapers WHERE paper_id = ?");
        $stmt->bind_param("i", $paperId);
        $stmt->execute();
        $result = $stmt->get_result();
        $caseStudy = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Case Study</title>
    <link rel="stylesheet" href="KB.css">
</head>
<body>
    <div class="main-content">
        <h2>Case Study Details</h2>
        <?php if ($caseStudy): ?>
            <h3><?php echo htmlspecialchars($caseStudy['title']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($caseStudy['content'])); ?></p>
            <small>Published on: <?php echo htmlspecialchars($caseStudy['published_at']); ?></small>
        <?php else: ?>
            <p>Case study not found.</p>
        <?php endif; ?>
        <a href="KB1.php" class="back-btn">Back to Case Studies</a>
    </div>
</body>
</html>
