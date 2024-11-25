<?php
                        include '../../connect/connect.php';
                        
                        // Prepare SQL with JOIN to get provider information
                        $sql = "SELECT a.*, p.full_name 
                                FROM appointments a 
                                LEFT JOIN serviceproviders p ON a.provider_id = p.provider_id 
                                WHERE a.client_id = ?";
                        
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $_SESSION['client_id']);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['appointment_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['service_type']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['appointment_date']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                echo "<td>";
                                
                                // Show edit button only if no provider assigned
                                if ($row['provider_id'] === null) {
                                    echo "<button class='btn edit-btn' data-id='" . $row['appointment_id'] . "'>Edit</button>";
                                }
                                
                                // Show cancel button only if provider is assigned and status is not cancelled
                                if ($row['provider_id'] !== null && $row['status'] !== 'cancelled') {
                                    echo "<button class='btn cancel-btn' data-id='" . $row['appointment_id'] . "'>Cancel</button>";
                                }
                                
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No appointments found</td></tr>";
                        }
                        
                        $stmt->close();
                        $conn->close();
                        exit();
                        ?>