<?php
    require_once('../../../config/config.php');
    $afDiv = "mainContent";
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        //check whether given id is an integer
        if (!is_numeric($id)) {
            $noticeType = "error";
            $error_message = "Enter A Numeric Value!";
            $data = ['noticeType' => $noticeType, 'error_message' => $error_message];
            echo json_encode($data);
        } else {
            $srch = "SELECT * FROM companyworkers WHERE worker_id = $id ";
            $result = $conn->query($srch);

            //checking whether worker exists or not
            if ($result->num_rows > 0) {
                //Removing the worker
                $status= "unset";
                $del = "UPDATE companyworkers SET status = '$status' WHERE worker_id = $id";
                $opert = $conn->query($del);

                if ($opert === true) {
                    $noticeType = "success";
                    $error_message = "Employee removed!";
                    $data = ['noticeType' => $noticeType, 'error_message' => $error_message];
                    echo json_encode($data);
                } else {
                    $noticeType = "error";
                    $error_message = $conn->error;
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