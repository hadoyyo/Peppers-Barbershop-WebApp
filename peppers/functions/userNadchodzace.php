<?php
    $upcomingAppointmentsQuery = "
    SELECT b.id, b.startDate, b.endDate, b.service, b.price, b.status, u.fullName AS barberName 
    FROM bookings b
    JOIN users u ON b.barberId = u.id
    WHERE b.clientId = ? AND b.status IN (0, 1, 5)
    ORDER BY b.status DESC, b.startDate ASC";
    $stmt = $mysqli->prepare($upcomingAppointmentsQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $startDate = strtotime($row['startDate']);
            $endDate = strtotime($row['endDate']);
            $currentTime = time();
            $status = $row['status'] == 5 ? "<i class='bi bi-hourglass-split'></i> W trakcie" : 
                      ($row['status'] == 1 ? "<i class='bi bi-check-lg'></i> Potwierdzona" : "<i class='bi bi-clock-fill'></i> Oczekuje na potwierdzenie");

            $formattedStartDate = date("d.m.Y H:i", $startDate);
            $formattedEndDate = date("H:i", $endDate);

            echo "
                <div class='appointment-item'>
                    <div>
                        <p class='color-red fs-5'><strong>{$row['service']}</strong></p>
                        <p class='color-red'>Barber: {$row['barberName']}</p>
                        <p class='color-red'>Czas: $formattedStartDate - $formattedEndDate</p>
                        <p class='color-red'>Cena: {$row['price']} zł</p>
                    </div>
            ";

            if ($currentTime < $startDate - 1800) {
                echo "
                <div class='appointment-buttons mb-3'> <!-- Ustawienie przycisków jeden pod drugim -->
                    <form method='POST' action='editBooking.php' class='edit-form' style='margin: 0;'>
                        <input type='hidden' name='bookingId' value='{$row['id']}'>
                        <button type='submit' class='btn custom-btn color-red'><i class='bi bi-pencil'></i> Edytuj</button>
                    </form>
                    <form method='POST' action='' class='cancel-form' onsubmit='return confirmCancellation();' style='margin: 0;'>
                        <input type='hidden' name='bookingId' value='{$row['id']}'>
                        <button type='submit' name='cancelBooking' class='btn custom-btn color-red'><i class='bi bi-x-lg'></i> Anuluj wizytę</button>
                    </form>
                </div>
                ";
            }

            echo "
                <div class='appointment-status' data-status='{$row['status']}'>$status</div>
                <hr class='color-red'>
            </div>
            ";
        }
    } else {
        echo "<br><p class='text-center color-red fs-5'><i class='bi bi-x-lg'></i> Brak nadchodzących wizyt.</p><br>";
    }
    ?>