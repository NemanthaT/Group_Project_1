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

// Handle form submission for updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare data
    $full_name = $_POST['full_name'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $introduction = $_POST['introduction'] ?? '';
    $field = $_POST['field'] ?? '';
    $speciality = $_POST['speciality'] ?? '';
    $service_description = $_POST['service_description'] ?? '';
    $certifications = $_POST['certifications'] ?? '';
    $awards = $_POST['awards'] ?? '';
    $image_url = '';

    // Handle image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../images/';
        $file_name = time() . '_' . basename($_FILES['profile_image']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            $image_url = $target_file;
        } else {
            echo "Failed to upload image";
            exit();
        }
    }

    // Update database
    $sql = "UPDATE serviceproviders SET 
        full_name = ?, 
        gender = ?, 
        email = ?, 
        phone = ?, 
        address = ?, 
        introduction = ?, 
        field = ?, 
        speciality = ?, 
        service_description = ?, 
        certifications = ?, 
        awards = ?" . 
        ($image_url ? ", profile_image = ?" : "") . 
        " WHERE provider_id = ?";

    $stmt = $conn->prepare($sql);

    if ($image_url) {
        $stmt->bind_param(
            "ssssssssssssi",
            $full_name,
            $gender,
            $email,
            $phone,
            $address,
            $introduction,
            $field,
            $speciality,
            $service_description,
            $certifications,
            $awards,
            $image_url,
            $provider_id
        );
    } else {
        $stmt->bind_param(
            "sssssssssssi",
            $full_name,
            $gender,
            $email,
            $phone,
            $address,
            $introduction,
            $field,
            $speciality,
            $service_description,
            $certifications,
            $awards,
            $provider_id
        );
    }

    if ($stmt->execute()) {
        // Update the provider array with new values for display
        $provider['full_name'] = $full_name;
        $provider['gender'] = $gender;
        $provider['email'] = $email;
        $provider['phone'] = $phone;
        $provider['address'] = $address;
        $provider['introduction'] = $introduction;
        $provider['field'] = $field;
        $provider['speciality'] = $speciality;
        $provider['service_description'] = $service_description;
        $provider['certifications'] = $certifications;
        $provider['awards'] = $awards;
        if ($image_url) {
            $provider['profile_image'] = $image_url;
        }
    } else {
        echo "Database update failed";
    }

    $stmt->close();
}

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
    <form id="profileForm" method="POST" enctype="multipart/form-data">
        <!-- Left Column -->
        <div class="left-column">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-image">
                    <img src="<?php echo htmlspecialchars($provider['profile_image'] ?: '../images/user.png'); ?>" alt="User Profile" id="profileImage">
                    <button type="button" class="edit-button">Edit</button>
                    <button type="submit" class="save-button" style="display: none;">Save</button>
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
        <!-- Hidden file input for profile image -->
        <input type="file" id="profileImageInput" name="profile_image" accept="image/*" style="display: none;">
    </form>
</div>
<script src="Profile.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>