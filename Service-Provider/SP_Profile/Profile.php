<?php
include '../Session/Session.php';
include '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <?php include '../Common template/SP_common.php'; ?>
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
        <img src="../images/user.png" alt="User  Profile">
        <button class="edit-button">Edit</button>
    </div>
    <h3>Safran</h3>
    <p>★★★★★</p> <!-- Star rating styled with CSS -->
    <ul class="profile-info">
        <li><strong>Name:</strong> Safran</li>
        <li><strong>Gender:</strong> Male</li>
        <li><strong>Email:</strong> Safran@gmail.com</li>
        <li><strong>Contact Number:</strong> +941234567</li>
        <li><strong>Address:</strong> 32 Nelson Place</li> <!-- Moved Address to the end for better order -->
    </ul>
    <h4>Social Media</h4>
    <ul class="social-media-links">
        <li><a href="#"><img src="../images/facebook.jpg" alt="Facebook"></a></li>
        <li><a href="#"><img src="../images/linkedin.png" alt="LinkedIn"></a></li>
        <li><a href="#"><img src="../images/instagram.jpg" alt="Instagram"></a></li>
    </ul>
</div>

<div class="service-stats">
            <h3>Service Stats</h3>
            <ul>
                <li>Completed: 10</li>
                <li>Assigned: 5</li>
                <li>Incomplete: 2</li>
                <li>Cancelled: 1</li>
            </ul>
        </div>
    </div>

    <!-- Right Column -->
    <div class="right-column">
        <!-- Service Stats -->
        
        <!-- Additional Info -->
        <div class="additional-info">
            <h3>Introduction</h3>
            <p>Name and Title: Safran, Business Consultant<br>
                Experience: "With over 10 years of experience in business strategy and process improvement, I specialize in helping organizations achieve sustainable growth."<br>
                Mission Statement: "My goal is to empower businesses to maximize their potential through tailored consulting solutions."<br>
                Contact Information: Email, Phone Number, Website<br></p>
            <h3>Service Description</h3>
            <p>Focus Areas: Business strategy, operational efficiency, and organizational change management<br>
                Target Audience: "I work with small-to-medium enterprises (SMEs) and startups looking to optimize their operations and scale their business."<br>
                Approach: "I use a collaborative, hands-on approach to identify challenges and deliver actionable insights."<br>
                Services Offered:<br>
                Business plan development<br>
                Process improvement strategies<br>
                One-on-one coaching for executives<br></p>
            <h3>Certifications/Licenses</h3>
            <p>Certified Management Consultant (CMC)<br>
                Professional Certified Coach (PCC) – International Coaching Federation<br>
                MBA in Strategic Management<br>
                Licensed Business Advisor<br></p>
            <h3>Awards</h3>
            <p>Top Consultant Award – Local Business Network, 2021<br>
                Excellence in Strategy Development – National Consulting Association, 2020<br>
                Outstanding Leadership Coaching Award – Regional Leadership Forum, 2019<br></p>
        </div>
    </div>
</div>
</div>
</div>   <!--this is the </div> of container in the common file, don't remove it-->
<script src="Edit.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>