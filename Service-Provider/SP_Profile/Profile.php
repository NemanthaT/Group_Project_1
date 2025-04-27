<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

// Ensure the user is logged in and provider_id is set
if (!isset($_SESSION['provider_id'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch service provider details from the database
$provider_id = $_SESSION['provider_id'];
$sql = "SELECT full_name, gender, email, phone, address, field, speciality, introduction, service_description, certifications, awards, profile_image 
        FROM serviceproviders 
        WHERE provider_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $provider_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $provider = $result->fetch_assoc();
} else {
    // Handle case where no provider is found
    $provider = [
        'full_name' => 'Unknown',
        'gender' => 'N/A',
        'email' => 'N/A',
        'phone' => 'N/A',
        'address' => 'N/A',
        'field' => 'N/A',
        'speciality' => 'N/A',
        'service_description' => 'N/A',
        'introduction' => 'N/A',
        'certifications' => 'N/A',
        'awards' => 'N/A',
        'profile_image' => '../images/user.png'
    ];
}
$stmt->close();

// Fetch project stats from the projects table
$project_stats = [
    'Assigned' => 0,
    'Completed' => 0,
    'Ongoing' => 0,
    'Cancelled' => 0
];

// Fetch total projects for Assigned
$sql = "SELECT COUNT(*) as total 
        FROM projects 
        WHERE provider_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $provider_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $project_stats['Assigned'] = $row['total'];
}
$stmt->close();

// Fetch project status counts
$sql = "SELECT LOWER(project_status) as project_status, COUNT(*) as count 
        FROM projects 
        WHERE provider_id = ? 
        GROUP BY LOWER(project_status)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $provider_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $status = ucfirst($row['project_status']); // Capitalize for consistency
    if (array_key_exists($status, $project_stats)) {
        $project_stats[$status] = $row['count'];
    }
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="Profile.css">
</head>
<body>
<div class="main-content">
    <div class="profile-section">
        <!-- Left Column -->
        <div class="left-column">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-image">
                    <img src="<?php echo htmlspecialchars($provider['profile_image'] ?: '../images/user.png'); ?>" alt="User Profile" id="profileImage">
                    <button class="edit-button">Edit</button>
                </div>
                <h3 id="profileName"><?php echo htmlspecialchars($provider['full_name']); ?></h3>
                <!-- <p>★★★★★</p> Star rating styled with CSS -->
                <ul class="profile-info">
                    <li><strong>Name:</strong> <span id="name"><?php echo htmlspecialchars($provider['full_name']); ?></span></li>
                    <li><strong>Gender:</strong> <span id="gender"><?php echo htmlspecialchars($provider['gender']); ?></span></li>
                    <li><strong>Email:</strong> <span id="email"><?php echo htmlspecialchars($provider['email']); ?></span></li>
                    <li><strong>Contact Number:</strong> <span id="phone"><?php echo htmlspecialchars($provider['phone']); ?></span></li>
                    <li><strong>Address:</strong> <span id="address"><?php echo htmlspecialchars($provider['address']); ?></span></li>
                </ul>
                <!-- <h4>Social Media</h4>
                <ul class="social-media-links">
                    <li><a href="#"><img src="../images/facebook.jpg" alt="Facebook"></a></li>
                    <li><a href="#"><img src="../images/linkedin.png" alt="LinkedIn"></a></li>
                    <li><a href="#"><img src="../images/instagram.jpg" alt="Instagram"></a></li>
                </ul> -->
            </div>

            <div class="service-stats">
                <h3>Service Stats</h3>
                <ul>
                    <li>Assigned: <?php echo $project_stats['Assigned']; ?></li>
                    <li>Completed: <?php echo $project_stats['Completed']; ?></li>      
                    <li>Ongoing: <?php echo $project_stats['Ongoing']; ?></li>
                    <li>Cancelled: <?php echo $project_stats['Cancelled']; ?></li>
                </ul>
            </div>
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <div class="additional-info">
                <h3>Introduction</h3>
                <p><span id="introduction"><?php echo nl2br(htmlspecialchars($provider['introduction'])); ?></span></p>
                <h3>Service Description</h3>
                <p>
                    <strong>Focus Area:</strong> <span id="field"><?php echo htmlspecialchars($provider['field']); ?></span><br>
                    <strong>Speciality:</strong> <span id="speciality"><?php echo htmlspecialchars($provider['speciality']); ?></span><br>
                    <strong>Description:</strong> <span id="service_description"><?php echo nl2br(htmlspecialchars($provider['service_description'])); ?></span>
                </p>
                <h3>Certifications/Licenses</h3>
                <p><span id="certifications"><?php echo nl2br(htmlspecialchars($provider['certifications'])); ?></span></p>
                <h3>Awards</h3>
                <p><span id="awards"><?php echo nl2br(htmlspecialchars($provider['awards'])); ?></span></p>
            </div>
        </div>
    </div>
</div>
</div>
<script src="Profile.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>