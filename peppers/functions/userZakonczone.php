<?php
    $completedAppointmentsQuery = "
    SELECT b.id, b.startDate, b.endDate, b.service, b.price, b.status, u.fullName AS barberName 
    FROM bookings b
    JOIN users u ON b.barberId = u.id
    WHERE b.clientId = ? AND b.status IN (2, 3, 4)
    ORDER BY b.status DESC, b.startDate ASC";
    
    $stmt = $mysqli->prepare($completedAppointmentsQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        //jeśli istnieją zakończone wizyty
        while ($row = $result->fetch_assoc()) {
            $startDate = strtotime($row['startDate']);
            $endDate = strtotime($row['endDate']);
            $service = $row['service'];
            $price = $row['price'];
            $barberName = $row['barberName'];
            $bookingId = $row['id'];
            $status = '';

            if ($row['status'] == 2) {
                $status = "<i class='bi bi-x-lg'></i> Odrzucona przez barbera";
            } elseif ($row['status'] == 3) {
                $status = "<i class='bi bi-x-lg'></i> Anulowana";
            } elseif ($row['status'] == 4) {
                $status = "<i class='bi bi-check-lg'></i> Zakończona";
            }
        
            $formattedStartDate = date("d.m.Y H:i", $startDate);
            $formattedEndDate = date("H:i", $endDate);
        
            echo "
            <div class='appointment-item'>
                <div>
                    <p class='color-red fs-5'><strong>$service</strong></p>
                    <p class='color-red'>Barber: $barberName</p>
                    <p class='color-red'>Czas: $formattedStartDate - $formattedEndDate</p>
                    <p class='color-red'>Cena: $price zł</p>
                </div>
            ";

            echo "
                <div class='appointment-status' data-status='{$row['status']}'>$status</div>
                <hr class='color-red'>
            </div>
            ";
        }
    } else {
        echo "<br><p class='text-center color-red fs-5'><i class='bi bi-x-lg'></i> Brak zakończonych wizyt.</p><br>";
    }
    ?>