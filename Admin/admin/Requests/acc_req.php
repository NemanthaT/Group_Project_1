<?php
    require_once('../../../config/config.php');
    require_once('../../../sendemail/send.php');
    header('Content-Type: application/json'); // Set JSON response

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        
        // Select the request
        $stmt = $conn->prepare("SELECT * FROM providerrequests WHERE reqId = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        if ($row) {
            $genPsswd = rand(100000, 999999); // Generate a random password
            $usrnm = trim($row["full_name"], " "); // Generate a username
    
            // Insert the request into the serviceproviders table
            $insrt = $conn->prepare("INSERT INTO serviceproviders (password, username, full_name, email, phone, address, field, speciality)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            // Bind the parameters
            $insrt->bind_param("ssssssss", $genPsswd, $usrnm, $row["full_name"], $row["email"], $row["phone"], $row["address"], $row["field"], $row["specialty"]);
            $insrt->execute();
            $insrt->close();
            
            // Send email to the user
            $data = [
                'email' => $row["email"],
                'subject' => 'Account Created',
                'message' => "Your account has been created successfully. Your username is: $usrnm and your password is: $genPsswd"
            ];
            sendEmail($data);

            // Delete the request from the providerrequests table
            $stmt = $conn->prepare("UPDATE providerrequests SET status = 'unset' WHERE reqId = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
    
            echo json_encode(["message" => "Request accepted and added as a service provider."]);
        } else {
            echo json_encode(["error" => "No requests with this ID."]);
        }
    }
    $conn->close();

?>