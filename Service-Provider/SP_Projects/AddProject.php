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
    <link rel="stylesheet" href="Project.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
            </div>
            <ul class="menu">
                <li><a href="../SP_Dashboard/SPDash.php"><button><img src="../images/dashboard.png">Dashboard</button></a></li>
                <li><a href="../SP_Appointment/App.php"><button><img src="../images/appointment.png">Appointment</button></a></li>
                <li><a href="../SP_Message/Message.php"><button><img src="../images/message.png">Message</button></a></li>
                <li><a href="../SP_Projects/Project.php"><button><img src="../images/project.png">Project</button></a></li>
                <li><a href="../SP_Bill/Bill.php"><button><img src="../images/bill.png">Bill</button></a></li>
                <li><a href="../SP_Forum/Forum.php"><button><img src="../images/forum.png">Forum</button></a></li>
                <li><a href="../SP_KnowledgeBase/KB.php"><button><img src="../images/knowledgebase.png">KnowledgeBase</button></a></li>
            </ul>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-wrapper">
            <!-- Navbar -->
            <header>
                <nav class="navbar">       
                    <a href="../Home/Homepage/HP.html">Home</a>
                    <div class="notification">   
                        <a href="#"><img src="../images/notification.png" alt="Notifications"></a>
                    </div> 
                    <div class="profile">
                        <a href="../SP_Profile/Profile.php"><img src="../images/user.png" alt="Profile"></a>
                    </div>
                    <a href="../../Login/Logout.php" class="logout">Logout</a>
                </nav>
            </header>

            <!-- Main Content (Forum Page) -->
            <div class="main-content">
                <div class="project-section">
                    <center><h2>Add Project</h2></center>
                
                    <div class="project-form-container">
    <form class="project-form">
        <div class="form-field">
            <label for="project_name">Project Name</label>
            <input type="text" id="project_name" placeholder="Enter project name" required>
        </div>
        <div class="form-field">
            <label for="client_company">Select Client Company</label>
            <select id="client_company" required>
                <option value="">Select a company</option>
                <option value="Company A">Company A</option>
                <option value="Company B">Company B</option>
                <option value="Company C">Company C</option>
            </select>
        </div>
        <div class="form-field">
            <label for="client_name">Client Name</label>
            <input type="text" id="client_name" placeholder="Enter client name" required>
        </div>
        <div class="form-field">
            <label for="contact_number">Contact Number</label>
            <input type="tel" id="contact_number" placeholder="Enter contact number" required>
        </div>
        <div class="form-field">
            <label for="project_description">Project Description</label>
            <textarea id="project_description" placeholder="Describe the project" required></textarea>
        </div>
        <div class="form-field">
            <label for="project_phase">Select Project Phase</label>
            <select id="project_phase" required>
                <option value="">Select a phase</option>
                <option value="Planning">Planning</option>
                <option value="Execution">Execution</option>
                <option value="Closure">Closure</option>
            </select>
        </div>
        <div class="form-field">
            <label for="project_status">Project Status Update</label>
            <input type="text" id="project_status" placeholder="Enter project status" required>
        </div>
        <div class="form-field">
            <label for="upload_documents">Upload Documents</label>
            <input type="file" id="upload_documents" multiple>
        </div>
        <button type="submit" class="submit-button">Add Project</button>
    </for>
</div>
            </div>    

</body>
</html>
