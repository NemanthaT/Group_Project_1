<?php
include '../Session/Session.php';
include '../connection.php';
include '../Common template/SP_common.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $providerId = $_SESSION['provider_id'];
    $project_id = trim($_POST['project_id']);
    $amount = $_POST['amount'];
    $description = trim($_POST['description']);
    $bill_date = $_POST['bill_date'];
    $payment_status = $_POST['payment_status'];
    $errors = [];

    if (empty($project_id)) $errors[] = "Project ID is required.";
    if (!is_numeric($amount) || $amount <= 0) $errors[] = "Amount must be a positive number.";
    if (empty($description)) $errors[] = "Description is required.";
    if (empty($bill_date)) $errors[] = "Bill date is required.";
    if (!in_array($payment_status, ['paid', 'unpaid'])) $errors[] = "Invalid payment status.";

    if (count($errors) > 0) {
        // Store errors in session and redirect back
        $_SESSION['bill_errors'] = $errors;
        // Optionally, store old input values to repopulate the form
        $_SESSION['bill_old'] = $_POST;
        header("Location: Bill.php");
        exit;
    }
    // Check if the project ID exists
    $stmt = $conn->prepare("SELECT * FROM projects WHERE project_id = ? AND provider_id = ?");
    $stmt->bind_param("ii", $project_id, $providerId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        // Project ID does not exist or you are not authorized.
        $_SESSION['bill_errors'] = ["Project ID does not exist or you are not authorized."];
        header("Location: Bill.php");
        exit;
    }
    else
    {
        $stmt = $conn->prepare("INSERT INTO bills (project_id, Description, Bill_Date, Amount, status) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("issds", $project_id, $description, $bill_date, $amount, $payment_status);
            $stmt->execute();
            $stmt->close();
        } else {
            // Handle prepare failure
            $_SESSION['bill_errors'] = ["Failed to prepare the SQL statement."];
            header("Location: Bill.php");
            exit;
        }    
        // On success, clear old input
        unset($_SESSION['bill_old']);
        header("Location: Bill.php?success=1");
        exit;
    }
}
exit;
?>
