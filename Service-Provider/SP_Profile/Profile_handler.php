<?php
include '../Session/Session.php';
include '../connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['provider_id'])) {
    echo "Unauthorized";
    exit();
}

$provider_id = $_SESSION['provider_id'];

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
    echo "success";
} else {
    echo "Database update failed";
}

$stmt->close();
$conn->close();
?>