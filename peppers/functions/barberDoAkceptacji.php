<?php
            $toApproveQuery = "
            SELECT b.id, b.startDate, b.endDate, b.service, b.price, u.fullName AS clientName 
            FROM bookings b
            JOIN users u ON b.clientId = u.id
            WHERE b.barberId = ? AND b.status = 0
            ORDER BY b.startDate ASC";
            
            $stmt = $mysqli->prepare($toApproveQuery);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $formattedStartDate = date("d.m.Y H:i", strtotime($row['startDate']));
                    $formattedEndDate = date("H:i", strtotime($row['endDate']));
                    echo "
                    <div class='appointment-item'>
                        <div class='appointment-details'>
                            <p class='color-red fs-5'><strong>{$row['service']}</strong></p>
                            <p class='color-red'>Klient: {$row['clientName']}</p>
                            <p class='color-red'>Czas: $formattedStartDate - $formattedEndDate</p>
                            <p class='color-red'>Cena: {$row['price']} zł</p>
                        </div>
                        <form method='POST' action='' class='action-form'>
                            <input type='hidden' name='bookingId' value='{$row['id']}'>
                            <button type='submit' name='acceptBooking' class='btn custom-btn color-red'><i class='bi bi-check-lg'></i> Akceptuj</button>
                            <button type='submit' name='rejectBooking' class='btn custom-btn color-red'><i class='bi bi-x-lg'></i> Odrzuć</button>
                        </form>
                        <div class='appointment-status' data-status='0' style='background-color: #ffc107; color: black; padding: 5px 10px; border-radius: 5px; font-weight: bold; margin-top: 10px;'>
                        <i class='bi bi-exclamation-circle'></i> Wymaga akceptacji
                        </div>
                        <hr class='color-red'>
                    </div>
                    ";
                }
            } else {
                echo "<p class='text-center color-red fs-5 mt-5'><i class='bi bi-x-lg'></i> Brak wizyt do akceptacji.</p>";
            }
?>