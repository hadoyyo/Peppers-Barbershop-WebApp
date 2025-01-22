<!-- Sortowanie -->
<div class="text-center mb-4" style="display:flex;justify-content: center;">
        <form method="GET" action="" class="d-inline">
            <select name="filter" class="form-select w-auto select-with-arrow" onchange="this.form.submit();">
                <option value="all" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'all' ? 'selected' : ''; ?>>Wszystkie</option>
                <option value="today" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'today' ? 'selected' : ''; ?>>Dziś</option>
                <option value="week" <?php echo isset($_GET['filter']) && $_GET['filter'] == 'week' ? 'selected' : ''; ?>>Tydzień</option>
            </select>
        </form>
</div>

<?php
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
    
    if ($filter == 'today') {
        //wizyty na dziś
        $upcomingQuery = "
        SELECT b.id, b.startDate, b.endDate, b.service, b.price, b.status, u.fullName AS clientName 
        FROM bookings b
        JOIN users u ON b.clientId = u.id
        WHERE b.barberId = ? AND b.status IN (1, 5) AND DATE(b.startDate) = CURDATE()
        ORDER BY b.startDate ASC";
    } elseif ($filter == 'week') {
        //wizyty w tym tygodniu
        $upcomingQuery = "
        SELECT b.id, b.startDate, b.endDate, b.service, b.price, b.status, u.fullName AS clientName 
        FROM bookings b
        JOIN users u ON b.clientId = u.id
        WHERE b.barberId = ? AND b.status IN (1, 5) AND WEEK(b.startDate) = WEEK(CURDATE())
        ORDER BY b.startDate ASC";
    } else {
        //wszystkie wizyty nadchodzące
        $upcomingQuery = "
        SELECT b.id, b.startDate, b.endDate, b.service, b.price, b.status, u.fullName AS clientName 
        FROM bookings b
        JOIN users u ON b.clientId = u.id
        WHERE b.barberId = ? AND b.status IN (1, 5) AND b.startDate > CURDATE()
        ORDER BY b.startDate ASC";
    }

    $stmt = $mysqli->prepare($upcomingQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    //jeśli są wizyty
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $formattedStartDate = date("d.m.Y H:i", strtotime($row['startDate']));
            $formattedEndDate = date("H:i", strtotime($row['endDate']));
            
            $statusText = '';
            $statusClass = '';
            if ($row['status'] == 1) {
                $statusText = "<i class='bi bi-check-lg'></i> Potwierdzona";
                $statusClass = "rgb(108, 189, 69)";
            } elseif ($row['status'] == 5) {
                $statusText = "<i class='bi bi-hourglass-split'></i> W trakcie";
                $statusClass = "rgb(108, 189, 69)";
            }

            echo "
            <div class='appointment-item'>
                <div class='appointment-details'>
                    <p class='color-red fs-5'><strong>{$row['service']}</strong></p>
                    <p class='color-red'>Klient: {$row['clientName']}</p>
                    <p class='color-red'>Czas: $formattedStartDate - $formattedEndDate</p>
                    <p class='color-red'>Cena: {$row['price']} zł</p>
                </div>
                <form method='POST' action='' class='cancel-form mb-3' onsubmit='return confirmCancellation();'>
                    <input type='hidden' name='bookingId' value='{$row['id']}'>
                    <button type='submit' name='cancelBooking' class='btn custom-btn color-red'><i class='bi bi-x-lg'></i> Anuluj wizytę</button>
                </form>
                <div class='appointment-status' style='background-color: $statusClass; color: black; padding: 5px 10px; border-radius: 5px; font-weight: bold;'>
                    $statusText
                </div>
                <hr class='color-red'>
            </div>
            ";
        }
    } else {
        echo "<p class='text-center color-red fs-5 mt-5'><i class='bi bi-x-lg'></i> Brak nadchodzących wizyt w danym przedziale czasu.</p>";
    }
    ?>