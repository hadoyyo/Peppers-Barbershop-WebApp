<?php
$completedQuery = "
SELECT b.id, b.startDate, b.endDate, b.service, b.price, b.status, u.fullName AS clientName 
FROM bookings b
JOIN users u ON b.clientId = u.id
WHERE b.barberId = ? AND b.status IN (2, 3, 4)
ORDER BY b.startDate ASC";

$stmt = $mysqli->prepare($completedQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $formattedStartDate = date("d.m.Y H:i", strtotime($row['startDate']));
        $formattedEndDate = date("H:i", strtotime($row['endDate']));
        $statusText = '';
        $statusClass = '';

        if ($row['status'] == 2) {
            $statusText = "<i class='bi bi-x-lg'></i> Odrzucona";
            $statusClass = "rgb(230, 29, 35)";
        } elseif ($row['status'] == 3) {
            $statusText = "<i class='bi bi-x-lg'></i> Anulowana";
            $statusClass = "rgb(230, 29, 35)";
        } elseif ($row['status'] == 4) {
            $statusText = "<i class='bi bi-check-lg'></i> Zakończona";
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
            <div class='appointment-status' style='background-color: $statusClass; color: black; padding: 5px 10px; border-radius: 5px; font-weight: bold;'>
                $statusText
            </div>
            <hr class='color-red'>
        </div>
        ";
    }
} else {
    echo "<p class='text-center color-red fs-5 mt-5'><i class='bi bi-x-lg'></i> Brak zakończonych wizyt.</p>";
}
?>