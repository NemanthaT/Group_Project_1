<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

if (!isset($_SESSION['provider_id'])) {
    die("Unauthorized access. Please log in as a provider.");
}

$providerId = $_SESSION['provider_id'];


     $statusResult = $conn->query("SELECT DISTINCT status FROM appointments");
        if ($statusResult && $statusResult->num_rows > 0) {
        while ($statusRow = $statusResult->fetch_assoc()) {
            $statusValue = htmlspecialchars($statusRow['status']);
            echo "<option value=\"$statusValue\">" . ucfirst($statusValue) . "</option>";
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
    <link rel="stylesheet" href="Forum.css">
</head>
<body>
    <div class="main-content">
        <div class="forum-section">
            <center><h2>Forum</h2></center>
            <div class="filter-group search-group">
                <input type="text" id="searchInput" placeholder="Search forum topics">
                <button class="search-button" id="searchButton" onclick="searchTopics()">Search</button>
                <button class="clear-button" id="clearButton" onclick="clearSearch()">Clear</button>
                <button class="search-button" onclick="openCreateThreadModal()">+ Create Thread</button>
            </div>

            <!-- Forum Categories -->
            <div class="forum-categories">
                <h3>Categories</h3>
                <ul id="category-list">
                    <li><button onclick="filterByCategory('General Discussions')">General Discussions</button></li>
                    <li><button onclick="filterByCategory('Technical Support')">Technical Support</button></li>
                    <li><button onclick="filterByCategory('Product/Service Feedback')">Product/Service Feedback</button></li>
                    <li><button onclick="filterByCategory('How-to Guides')">How-to Guides</button></li>
                    <li><button onclick="filterByCategory('Off-Topic')">Off-Topic</button></li>
                </ul>
            </div>    

            <!-- Modal for Creating New Thread -->
            <div class="modal-overlay" id="createThreadModalOverlay" style="display: none;"></div>
            <div class="modal create-thread-modal" id="createThreadModal" style="display: none;">
                <h3>Create a New Thread</h3>
                <form action="" method="POST" onsubmit="return validateCreateThreadForm(event)">
                    <input type="hidden" name="action" value="create">
                    <label for="newThreadTitle">Title:</label>
                    <input type="text" id="newThreadTitle" name="title" class="input-field" placeholder="Enter thread title" maxlength="100" required>

                    <label for="newThreadCategory">Category:</label>
                    <select id="newThreadCategory" name="category" class="input-field" required>
                        <option value="General Discussions">General Discussions</option>
                        <option value="Technical Support">Technical Support</option>
                        <option value="Product/Service Feedback">Product/Service Feedback</option>
                        <option value="How-to Guides">How-to Guides</option>
                        <option value="Off-Topic">Off-Topic</option>
                    </select>

                    <label for="newThreadMessage">Message:</label>
                    <textarea id="newThreadMessage" name="message" class="input-field" rows="5" placeholder="Enter your message" maxlength="1000" required></textarea>

                    <button type="submit" class="submit-btn">Create</button>
                    <button type="button" onclick="closeCreateThreadModal()" class="cancel-btn">Cancel</button>
                </form>
            </div>

            <!-- Thread View Modal -->
            <div class="modal-overlay" id="modalOverlay" style="display: none;"></div>
            <div class="modal view-thread-modal" id="modalForm" style="display: none;">
                <h3>Thread Details</h3>
                <div class="thread-details">
                    <h4 id="modalTitle"></h4>
                    <p id="modalContent"></p>
                    <div class="thread-meta">
                        <span id="modalViews"></span> | <span id="modalReplies"></span>
                    </div>
                </div>
                <button type="button" onclick="closeModal()" class="cancel-btn">Close</button>
            </div>

            <!-- Forum Threads -->
            <div class="forum-threads">
    <div class="header-container">
        <h3>Recent Threads</h3>
        <a href="ViewForum.php" class="view-btn"><button class="view-btn">View Forums</button></a>
    </div>
    <ul id="thread-list">
        <?php if (empty($threads)): ?>
            <li class="no-threads">
                <p>No threads found. Be the first to create a thread!</p>
            </li>
        <?php else: ?>
            <?php foreach ($threads as $thread): ?>
                <li data-category="<?= htmlspecialchars($thread['category'] ?? 'General Discussions') ?>" id="thread-<?= $thread['forum_id'] ?>">
                    <h4><?= htmlspecialchars($thread['title']) ?></h4>
                    <p>Started by<span class="username"><?=htmlspecialchars($thread['full_name'] ?? 'Unknown') ?></span> - <?= $thread['replies'] ?? 0 ?> replies</p>
                    <div class="button-container">
                        <button class="view-btn" onclick="viewThread('<?= htmlspecialchars(addslashes($thread['title'])) ?>', '<?= htmlspecialchars(addslashes($thread['content'])) ?>', <?= $thread['views'] ?? 0 ?>, <?= $thread['replies'] ?? 0 ?>)">View</button>
                        <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this thread?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="forum_id" value="<?= $thread['forum_id'] ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
        </div>
    </div>
    <script>
        // Search Functionality
        document.querySelector('.search-button').addEventListener('click', function () {
    const searchValue = document.querySelector('#search-input').value.trim().toLowerCase();
    const rows = document.querySelectorAll('#message-tbody tr');

    rows.forEach(row => {
        const clientName = row.children[0].textContent.toLowerCase();
        const topic = row.children[1].textContent.toLowerCase();
        row.style.display = (clientName.includes(searchValue) || topic.includes(searchValue)) ? '' : 'none';
    });
    });

    // Open Create Chat Modal, should add a button to open the modal<button class="create-chat-button">Create New Chat</button>
    document.querySelector('.create-chat-button').addEventListener('click', function () {
    document.getElementById('create-chat-modal').style.display = 'flex';
    });

    function enterEditMode() {
    // Replace text with input fields, adding restrictions and required attributes
    document.querySelector("#name").outerHTML = `<input type="text" id="name" name="full_name" value="${document.querySelector("#name").textContent}" pattern="[A-Za-z\\s]{2,50}" maxlength="50" title="Name must be 2-50 characters, letters and spaces only" required>`;
    document.querySelector("#gender").outerHTML = `<select id="gender" name="gender" required>
        <option value="Male" ${document.querySelector("#gender").textContent === "Male" ? "selected" : ""}>Male</option>
        <option value="Female" ${document.querySelector("#gender").textContent === "Female" ? "selected" : ""}>Female</option>
        <option value="Other" ${document.querySelector("#gender").textContent === "Other" ? "selected" : ""}>Other</option>
    </select>`;
    document.querySelector("#email").outerHTML = `<input type="email" id="email" name="email" value="${document.querySelector("#email").textContent}" maxlength="100" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}" title="Enter a valid email address" required>`;
    document.querySelector("#phone").outerHTML = `<input type="tel" id="phone" name="phone" value="${document.querySelector("#phone").textContent}" pattern="(\\+94[0-9]{9}|0[0-9]{9})" maxlength="12" title="Phone number must start with +94 or 0, followed by 9 digits" required>`;
    document.querySelector("#address").outerHTML = `<input type="text" id="address" name="address" value="${document.querySelector("#address").textContent}" maxlength="200" pattern="[A-Za-z0-9\\s,.-]{5,200}" title="Address must be 5-200 characters, letters, numbers, spaces, commas, periods, or hyphens only" required>`;
    document.querySelector("#NIC").outerHTML = `<input type="text" id="NIC" name="NIC" value="${document.querySelector("#NIC").textContent}" pattern="[0-9]{9}[vV]|[0-9]{12}" maxlength="12" title="NIC must be 9 digits followed by 'v'/'V' or 12 digits" required>`;
    document.querySelector("#introduction").outerHTML = `<textarea id="introduction" name="introduction" maxlength="500" required>${document.querySelector("#introduction").textContent}</textarea>`;
    document.querySelector("#field").outerHTML = `<input type="text" id="field" name="field" value="${document.querySelector("#field").textContent}" pattern="[A-Za-z\\s]{2,50}" maxlength="50" title="Field must be 2-50 characters, letters and spaces only" required>`;
    document.querySelector("#speciality").outerHTML = `<input type="text" id="speciality" name="speciality" value="${document.querySelector("#speciality").textContent}" pattern="[A-Za-z\\s]{2,50}" maxlength="50" title="Speciality must be 2-50 characters, letters and spaces only" required>`;
    document.querySelector("#service_description").outerHTML = `<textarea id="service_description" name="service_description" maxlength="1000" required>${document.querySelector("#service_description").textContent}</textarea>`;
    document.querySelector("#certifications").outerHTML = `<textarea id="certifications" name="certifications" maxlength="1000">${document.querySelector("#certifications").textContent}</textarea>`;
    document.querySelector("#awards").outerHTML = `<textarea id="awards" name="awards" maxlength="1000">${document.querySelector("#awards").textContent}</textarea>`;

    document.querySelector("#gender").outerHTML = `
            <div id="gender">
                <label><input type="radio" name="gender" value="Male" ${document.querySelector("#gender").textContent === "Male" ? "checked" : ""} required> Male</label>
                <label><input type="radio" name="gender" value="Female" ${document.querySelector("#gender").textContent === "Female" ? "checked" : ""} required> Female</label>
                <label><input type="radio" name="gender" value="Other" ${document.querySelector("#gender").textContent === "Other" ? "checked" : ""} required> Other</label>
            </div>`
}

    
    </script>
    <script src="Forum.js"></script>
    <script src="../Common template/Calendar.js"></script>
</body>
</html>