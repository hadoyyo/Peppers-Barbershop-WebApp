<?php
//akceptacja, odrzucenie, anulowanie wizyty
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acceptBooking'])) {
        //akceptacja
        $bookingId = intval($_POST['bookingId']);
        $query = "UPDATE bookings SET status = 1 WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $bookingId);
        if ($stmt->execute()) {
             echo "<script> window.location.href = 'barberBookings.php'; </script>";
        } else {
            alert('Błąd podczas akceptacji wizyty.');
        }
    } elseif (isset($_POST['rejectBooking'])) {
        //odrzucenie
        $bookingId = intval($_POST['bookingId']);
        $query = "UPDATE bookings SET status = 2 WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $bookingId);
        if ($stmt->execute()) {
            echo "<script> window.location.href = 'barberBookings.php'; </script>";
        } else {
            alert('Błąd podczas anulowania wizyty.');
        }
    } elseif (isset($_POST['cancelBooking'])) {
        //anulowanie
        $bookingId = intval($_POST['bookingId']);
        $query = "UPDATE bookings SET status = 3 WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("i", $bookingId);
        if ($stmt->execute()) {
            echo "<script> window.location.href = 'barberBookings.php'; </script>";
        } else {
            alert('Błąd podczas anulowania wizyty.');
        }
    }
}

//logika statusów
$updateStatusesQuery = "
    SELECT id, startDate, endDate, status 
    FROM bookings 
    WHERE barberId = ?";
$stmt = $mysqli->prepare($updateStatusesQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $startDate = strtotime($row['startDate']);
    $endDate = strtotime($row['endDate']);
    $currentTime = time();

    if ($row['status'] == 1) {
        if ($currentTime >= $startDate && $currentTime <= $endDate) {
            //zmiana na "W trakcie"
            $updateStatusQuery = "UPDATE bookings SET status = 5 WHERE id = ?";
            $stmt = $mysqli->prepare($updateStatusQuery);
            $stmt->bind_param("i", $row['id']);
            $stmt->execute();
        } elseif ($currentTime > $endDate) {
            //zmiana na "Zakończona jeśli czas minął
            $updateStatusQuery = "UPDATE bookings SET status = 4 WHERE id = ?";
            $stmt = $mysqli->prepare($updateStatusQuery);
            $stmt->bind_param("i", $row['id']);
            $stmt->execute();
        }
    } elseif ($row['status'] == 0 && $currentTime > ($startDate - 900)) {
        //zmień status na "Potwierdzona" 15 przed rozpoczeciem, jeśli nadal jest oczekująca ($startDate - 900 sekund)
        $updateStatusQuery = "UPDATE bookings SET status = 1 WHERE id = ?";
        $stmt = $mysqli->prepare($updateStatusQuery);
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();
    } elseif ($row['status'] == 5 && $currentTime > $endDate) {
        //zmień status na "zakończona" (dla statusu 5)
        $updateStatusQuery = "UPDATE bookings SET status = 4 WHERE id = ?";
        $stmt = $mysqli->prepare($updateStatusQuery);
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();
    }
}
?>