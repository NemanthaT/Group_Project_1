<?php
    require_once('../../config/config.php');
    header('Content-Type: application/json');
    $afDiv = "mainContent";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        if (!is_numeric($id)) {
            $noticeType = "error";
            $error_message = "Enter a Numeric ID!";
            $data = ['noticeType' => $noticeType, 'error_message' => $error_message];
            echo json_encode($data);

        } else {
            $role = $_POST['role'];
            $srch = "SELECT * FROM companyworkers WHERE worker_id = $id AND status = 'set' ";
            $result = $conn->query($srch);

            //checking whether worker exists or not
            if ($result->num_rows > 0) {
                //Changing the role
                $chng = "UPDATE companyworkers SET role = " . " ' " . $role . " ' " . " WHERE worker_id = $id AND status = 'set' ";
                $opert = $conn->query($chng);

                if ($opert === true) {
                    $noticeType = "success";
                    $error_message = "Role Changed Successfully!";
                    $data = ['noticeType' => $noticeType, 'error_message' => $error_message];
                    echo json_encode($data);
                } else {
                    $noticeType = "error";
                    $error_message = "Error: " . $conn->error;
                    $data = ['noticeType' => $noticeType, 'error_message' => $error_message];
                    echo json_encode($data);
                }

            } else {
                $noticeType = "error";
                $error_message = "No Employee found!!";
                $data = ['noticeType' => $noticeType, 'error_message' => $error_message];
                echo json_encode($data);

            }
        }
    }

?>