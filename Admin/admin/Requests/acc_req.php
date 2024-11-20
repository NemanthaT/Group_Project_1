<?php
    require_once('../../config/config.php');
    header('Content-Type: application/json'); // Set JSON response


    /*if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = intval($_POST['id']);

        $stmt = $conn->prepare("SELECT * FROM providerrequests WHERE reqId = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $genPsswd = rand(100000, 999999);//generate a random password
        $usrnm = trim($row["full_name"], " ") . $genPsswd;//generate a username

        //insert the request into the serviceproviders table
        $insrt = $conn->prepare("INSERT INTO serviceproviders (password, username, full_name, email, phone, address, field, speciality)
                                VALUES (?, ?, ?, ?, ?, ?)");
        //bind the parameters
        $insrt->bind_param("sssisss", $genPsswd, $row["full_name"], $row["email"], $row["phone"], $row["address"], $row["field"], $row["specialty"]);
        //$insrt->bind_param($genPsswd, $row['full_name'], $row['email'], $row['phone'], $row['address'], $row['field'], $row['speciality']);
        $insrt->execute();
        $insrt->close();

        //delete the request from the providerrequests table
        $stmt = $conn->prepare("DELETE FROM providerrequests WHERE reqId = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            echo json_encode($row);
        } else {
            echo json_encode(["error" => "No requests with this ID."]);
        }

        $stmt->close();
    }
    $conn->close();*/

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
    
            // Delete the request from the providerrequests table
            $stmt = $conn->prepare("DELETE FROM providerrequests WHERE reqId = ?");
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