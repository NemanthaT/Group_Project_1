<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

$project_id = $_POST['project_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDSA Lanka Consultancy</title>
    <link rel="stylesheet" href="../Common template/SP_common.css">
    <link rel="stylesheet" href="Bill.css">
</head>
<body> 
        <div class="main-content">
            <?php
            if (isset($_SESSION['bill_errors'])) {
                echo "<div class='create-bill-section' style='background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; margin-bottom: 15px;'>";
                echo "<p style='margin: 0; font-size: 14px;'>" . (is_array($_SESSION['bill_errors']) ? implode(', ', $_SESSION['bill_errors']) : $_SESSION['bill_errors']) . "</p>";
                echo "</div>";
                unset($_SESSION['bill_errors']);
            }
            ?>
            <div class="bill-section">
                <div class="back-link">
                    <a href="Bill.php">← Back to Bills</a>
                </div>
                <h2>Add Bill</h2>
                <form action="process_bill.php?project_id=<?php echo $project_id; ?>" method="POST" class="simple-form">

                  
                       
                    <div class="form-field">
                        <label for="amount">Amount (Rs)</label>
                        <input type="number" id="amount" name="amount" placeholder="Enter amount" min="1" step="0.01" required>
                    </div>
                    
                    <div class="form-field">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Describe the bill" rows="4" required></textarea>
                    </div>
                    
                    <div class="form-field">
                        <label for="bill_date">Bill Date</label>
                        <input type="date" id="bill_date" name="bill_date" required>
                    </div>

                    
                    <div class="form-actions">
                        <button type="button" class="cancel-button" onclick="window.location.href='Bill.php'">Cancel</button>
                        <button type="submit" class="submit-button">Add Bill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>   
<script src="Bill.js"></script>
<script src="../Common template/Calendar.js"></script>
</body>
</html>