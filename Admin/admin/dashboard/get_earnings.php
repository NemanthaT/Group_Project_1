<?php
    require_once('../../../config/config.php');

    $query = "SELECT MONTH(paid_on) AS month, SUM(Amount) AS total 
            FROM bills 
            WHERE status = 'paid' AND YEAR(paid_on) = YEAR(CURDATE())
            GROUP BY MONTH(paid_on)";

    $result = mysqli_query($conn, $query);

    $monthlyEarnings = array_fill(0, 12, 0);

    while($row = mysqli_fetch_assoc($result)) {
        $monthIndex = (int)$row['month'] - 1;
        $monthlyEarnings[$monthIndex] = (float)$row['total'];
    }

    echo json_encode($monthlyEarnings);
?>