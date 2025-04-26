
    <?php
    include '../session/session.php';
    $projectId = $_GET['project_id'];

    $sqlproject = "SELECT * FROM `projects` WHERE `project_id` = ? ;";
    $sqlserviceproviders = "SELECT * FROM `serviceproviders` WHERE `provider_id` = ? ;";
    $doc ="SELECT * from projectdocuments where project_id = '$projectId';";
    $bill = "SELECT * from bills where project_id = '$projectId';";


    $stmt = $conn->prepare($sqlproject);
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    $provider_id = $result['provider_id'];
    $ProjectName = $result['project_name'];
    $ProjectID = $result['project_id'];

    $projectDescription = $result['project_description'];
    $createdDate = $result['created_date'];
    $projectStatus = $result['project_status'];
    $projectPhase = $result['project_phase'];

    $query = $conn->prepare($sqlserviceproviders);
    $query->bind_param("i", $provider_id);
    $query->execute();
    $queryResult = $query->get_result();
    $serviceproviders = $queryResult->fetch_assoc();
    $ServiceProviderName = $serviceproviders['full_name'];
    $ServiceProviderContact = $serviceproviders['phone'];

    $stmt->close();



    $docResult = $conn->query($doc);
    if ($docResult === false) {
        die("Error: " . $conn->error);
    }


    $billResult = $conn->query($bill);
    if ($billResult === false) {
        die("Error: " . $conn->error);
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EDSA Lanka - Appointment Management</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="sidebar">
            <div class="logo">
                <img src="../images/logo.png" alt="EDSA Lanka Consultancy Logo">
                </div>
                
                <ul class="menu">
                    <li>
                        <a href="../Dashboard/Dashboard.php">
                            <button >
                                <img src="../images/dashboard.png" alt="Dashboard">
                                Dashboard
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="../appointments/appointment.php">
                            <button >
                                <img src="../images/appointment.png" alt="Appointment">
                                Appointment
                            </button>
                        </a>
                        </li>
                    <li>
                        <a href="../Project/project.php">
                            <button class="active">
                                <img src="../images/project.png" alt="project">
                                Projects
                            </button>
                        </a>
                    </li>                
                    <li>
                        <a href="../bill/bill.php">
                            <button >
                            <img src="../images/bill.png" alt="Bill">
                            Bill
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="../forum/forum.php">
                        <button>
                            <img src="../images/forum.png" alt="Forum">
                            Forum
                        </button>
                        </a>
                    </li>
                    <li><a href="../Message/Message.php">
                        <button>
                            <img src="../images/Message.png" alt="Message">
                            Message
                        </button></a>
                    </li>
                    <!-- <li>
                        <a href="../reports/reports.php">
                            <button >
                                <img src="../images/reports.png" alt="Reports">
                                Reports
                            </button>
                        </a>
                    </li> -->
                </ul>
            </div>

            <!-- Main Content Area -->
            <div class="main-wrapper">
                <!-- Navbar -->
                <div class="navbar">
                    <a href="#">
                        <!-- <img src="../images/notification.png" alt="Notifications"> -->
                    </a>
                    <div class="profile">
                    <a href="../profile/profile.php">
                    <img src="../images/user.png" alt="Profile">
                        </a>
                    </div>
                    <a href="../../../Login/Logout.php" class="logout">Logout</a>
                </div>

        <div class=".main-container">
            <div class="space"></div>
            <div class="controls header card1">
                <h1><?php echo $ProjectName; ?></h1>
            </div>
            <div class="row margin">
            <div class="row-container">
                <h2>Project Details</h2>
                <hr><br>
                <p><strong>Project Name:</strong> <?php echo $ProjectName; ?></p>
                <p><strong>Project ID:</strong> <?php echo $ProjectID; ?></p>
                <p><strong>Service Provider Name :</strong> <?php echo $ServiceProviderName; ?></p>
                <p><strong>Service Provider Content Details :</strong> <?php echo $ServiceProviderContact; ?></p>    
            </div>
            <div class="row-container">
                <h2>Project Progress </h2>
                <hr><br>
                <p><strong>Project Start Date:</strong><?php echo $createdDate; ?></p>
                <p><strong>updated Date:</strong> <?php echo $UpdatedDate; ?></p>
                <div class="row">
                <p ><strong>Project Status : </strong> <?php echo $projectStatus; ?></p>
                </div>
                <p><strong>Project Phase :</strong> <?php echo $projectPhase; ?></p>
        </div>
        </div>
        <div class="controls">
                <h1>Documents</h1>
                <?php if ($docResult->num_rows > 0): ?>
                    <?php while ($doc_row = $docResult->fetch_assoc()): ?>

                <div class="box">
                    <h2><?php echo htmlspecialchars($doc_row['file_name']); ?></h2>
                    <br>
                    <a href="../<?php echo htmlspecialchars($doc_row['file_path']); ?>">
                    <div class="row center" >
                        <img class="pdf" src="../images/pdf.png" alt="">
                        <h3><?php echo htmlspecialchars($doc_row['file_name']); ?></h3>
                    </div>
                    </a>
                    
                </div> 
                <?php endwhile; ?>
                    <?php endif; ?>
            </div>
            
            <div class="controls">
                <h1>Bills</h1>
                <?php if ($billResult->num_rows > 0): ?>
                    <?php while ($bill_row = $billResult->fetch_assoc()): ?>

                <div class="box row">
                    <br>
                    <a href="../../user/bill/paybill.php?bill_id=<?php echo htmlspecialchars($bill_row['bill_id']); ?>" class="row center" style="text-decoration: none; color: inherit; justify-content: space-between;">       
                    <div class="row center" >
                        <img class="pdf" src="../images/bill.png" alt=""><div  style="flex-direction: column; text-align: left;">
                        <h2><?php echo htmlspecialchars($bill_row['Description']); ?></h2>
                        <h3>Rs <?php echo number_format($bill_row['Amount'], 2); ?></h3>
                        <h4 style="color: <?php echo $bill_row['status'] === 'Paid' ? 'green' : 'red'; ?>;">
                            <?php echo htmlspecialchars($bill_row['status']); ?>
                        </h4>      </div></div>
                    </a>
                    
                </div> 
                <?php endwhile; ?>
                    <?php endif; ?> 
            </div>
        </div>
    </div>
        <script src="script.js"></script>
    </body>
    </html>