<?php
    //filtrowanie
    $conditions = [];
    if (!empty($_GET['filter_service'])) {
        $conditions[] = "service LIKE '%" . $mysqli->real_escape_string($_GET['filter_service']) . "%'";
    }
    if (!empty($_GET['filter_price'])) {
        $conditions[] = "price = '" . $mysqli->real_escape_string($_GET['filter_price']) . "'";
    }
    if (!empty($_GET['filter_status2'])) {
        if ($_GET['filter_status2'] == "6") {
            $conditions[] = "status = 0";
        } else {
            $conditions[] = "status = '" . $mysqli->real_escape_string($_GET['filter_status2']) . "'";
        }
    }
    if (!empty($_GET['filter_barber'])) {
        $conditions[] = "barberId = '" . $mysqli->real_escape_string($_GET['filter_barber']) . "'";
    }

    //sortowanie
    $validColumns = ['id', 'startDate', 'endDate', 'clientId', 'barberId', 'service', 'price', 'status'];
    $sortColumn = isset($_GET['sort_column']) && in_array($_GET['sort_column'], $validColumns) ? $_GET['sort_column'] : 'id';
    $sortOrder = isset($_GET['sort_order']) && in_array($_GET['sort_order'], ['ASC', 'DESC']) ? $_GET['sort_order'] : 'ASC';

    $whereClause = count($conditions) > 0 ? "WHERE " . implode(" AND ", $conditions) : '';
    $bookingsQuery = "SELECT id, startDate, endDate, clientId, barberId, service, price, status FROM bookings $whereClause ORDER BY $sortColumn $sortOrder";

    $result = $mysqli->query($bookingsQuery);

    if ($result->num_rows > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-dark table-striped text-center mt-4'>";
        echo "<thead>
        <tr class='color-red'>
            <th><a href='?sort_column=id&sort_order=" . ($sortColumn == 'id' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>ID " . ($sortColumn == 'id' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=startDate&sort_order=" . ($sortColumn == 'startDate' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Początek " . ($sortColumn == 'startDate' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=endDate&sort_order=" . ($sortColumn == 'endDate' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Koniec " . ($sortColumn == 'endDate' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=clientId&sort_order=" . ($sortColumn == 'clientId' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Klient " . ($sortColumn == 'clientId' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=barberId&sort_order=" . ($sortColumn == 'barberId' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Barber " . ($sortColumn == 'barberId' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=service&sort_order=" . ($sortColumn == 'service' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Usługa " . ($sortColumn == 'service' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=price&sort_order=" . ($sortColumn == 'price' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Cena " . ($sortColumn == 'price' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th><a href='?sort_column=status&sort_order=" . ($sortColumn == 'status' && $sortOrder == 'ASC' ? 'DESC' : 'ASC') . "' style='text-decoration: none;'>Status " . ($sortColumn == 'status' ? ($sortOrder == 'ASC' ? $upArrow : $downArrow) : '') . "</a></th>
            <th>Akcje</th>
        </tr>
    </thead>";

        echo "<tbody>";
    
        while ($row = $result->fetch_assoc()) {
            $clientQuery = "SELECT fullName FROM users WHERE id = " . $row['clientId'];
            $clientResult = $mysqli->query($clientQuery);
            $clientName = ($clientResult->num_rows > 0) ? $clientResult->fetch_assoc()['fullName'] : 'Nieznany';
    
            $barberQuery = "SELECT fullName FROM users WHERE id = " . $row['barberId'];
            $barberResult = $mysqli->query($barberQuery);
            $barberName = ($barberResult->num_rows > 0) ? $barberResult->fetch_assoc()['fullName'] : 'Nieznany';
    
            if ($row['status'] == 0) {
                $statusText = "Oczekuje na potwierdzenie";
            } elseif ($row['status'] == 1) {
                $statusText = "Potwierdzona";
            } elseif ($row['status'] == 2) {
                $statusText = "Odrzucona przez barbera";
            } elseif ($row['status'] == 3) {
                $statusText = "Anulowana";
            } elseif ($row['status'] == 4) {
                $statusText = "Zakończona";
            } elseif ($row['status'] == 5) {
                $statusText = "W trakcie";
            } else {
                $statusText = "Nieznany";
            }
    
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['startDate']}</td>
                    <td>{$row['endDate']}</td>
                    <td>$clientName ({$row['clientId']})</td>
                    <td>$barberName ({$row['barberId']})</td>
                    <td>{$row['service']}</td>
                    <td>{$row['price']} zł</td>
                    <td>$statusText</td>
                    <td>";?>
                        <form method='POST' action='' style='display:inline-block;'>
                            <input type='hidden' name='bookingId' value="<?php echo $row['id']; ?>">
                            <button type='button' class='btn custom-btn-table btn-sm color-red mt-2' onclick="editBooking(<?= $row['id'] ?>)">
                                <i class='bi bi-pencil'></i> Edytuj
                            </button>
                        </form>
                        <form method='POST' action='' style='display:inline-block;'>
                            <input type='hidden' name='bookingId' value="<?php echo $row['id']; ?>">
                            <button type='submit' name='deleteBooking' class='btn custom-btn-table btn-sm color-red' onclick="return confirm('Czy na pewno chcesz usunąć tę wizytę?')">
                                <i class='bi bi-trash'></i> Usuń
                            </button>
                        </form>
                    </td>
                  </tr> <?php
        }
    
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    } else {
        echo "<p class='text-center color-red fs-5 mt-5'><i class='bi bi-x-lg'></i> Brak wizyt spełniających kryteria.</p>";
    }
    
    ?>
</div>