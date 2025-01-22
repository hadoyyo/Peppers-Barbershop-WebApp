<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancelBooking'])) {
    $bookingId = (int)$_POST['bookingId'];

    $cancelQuery = "UPDATE bookings SET status = 3 WHERE id = ?";
    $stmt = $mysqli->prepare($cancelQuery);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
            alert('Wizyta została anulowana.');
            window.location.href = window.location.href; // Odśwież stronę
        </script>";
    } else {
        echo "<script>
            alert('Nie udało się anulować wizyty. Spróbuj ponownie.');
        </script>";
    }
}

elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = $_POST['service'];
    $barberId = $_POST['barber'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    //ceny i czasy
    $prices = [
        'Strzyżenie włosów' => 100,
        'Strzyżenie zarostu' => 70,
        'Strzyżenie włosów i zarostu' => 130,
        'Repigmentacja zarostu' => 35,
        'Repigmentacja zarostu i włosów' => 60,
        'Farbowanie' => 110
    ];

    $durations = [
        'Strzyżenie włosów' => 30,
        'Strzyżenie zarostu' => 30,
        'Repigmentacja zarostu' => 30,
        'Strzyżenie włosów i zarostu' => 60,
        'Repigmentacja zarostu i włosów' => 60,
        'Farbowanie' => 60
    ];

    $price = $prices[$service];
    $duration = $durations[$service];

    $startDate = "$date $time";
    $endDate = date("Y-m-d H:i", strtotime("$startDate + $duration minutes"));

    $checkQuery = "
        SELECT * FROM bookings 
        WHERE barberId = ? 
        AND (startDate < ? AND endDate > ?)
        AND status IN (0, 1, 5)";
    $stmt = $mysqli->prepare($checkQuery);
    $stmt->bind_param("iss", $barberId, $endDate, $startDate);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p>Wybrany termin jest już zajęty.</p>";
    } else {
        //dodanie rezerwacji
        $insertQuery = "
            INSERT INTO bookings (startDate, endDate, clientId, barberId, service, price) 
            VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($insertQuery);
        $stmt->bind_param("ssiiss", $startDate, $endDate, $userId, $barberId, $service, $price);
        $stmt->execute();
        echo "<script>
            alert('Wizyta została pomyślnie przesłana barberowi do akceptacji!');
        </script>";
    }

    echo "<script>
    window.location.href = 'bookings.php';
    </script>";

}

include_once 'functions/functions.php';

//możliwe godziny rozpoczęcia wizyt
$availableHours = ["09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30"];

//logika ustawiania statusów
$updateStatusesQuery = "
    SELECT id, startDate, endDate, status 
    FROM bookings 
    WHERE clientId = ?";
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
            $updateStatusQuery = "UPDATE bookings SET status = 5 WHERE id = ?";
            $stmt = $mysqli->prepare($updateStatusQuery);
            $stmt->bind_param("i", $row['id']);
            $stmt->execute();
        } elseif ($currentTime > $endDate) {
            $updateStatusQuery = "UPDATE bookings SET status = 4 WHERE id = ?";
            $stmt = $mysqli->prepare($updateStatusQuery);
            $stmt->bind_param("i", $row['id']);
            $stmt->execute();
        }
    } elseif ($row['status'] == 0 && $currentTime > ($startDate - 900)) {
        $updateStatusQuery = "UPDATE bookings SET status = 1 WHERE id = ?";
        $stmt = $mysqli->prepare($updateStatusQuery);
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();
    } elseif ($row['status'] == 5 && $currentTime > $endDate) {
        $updateStatusQuery = "UPDATE bookings SET status = 4 WHERE id = ?";
        $stmt = $mysqli->prepare($updateStatusQuery);
        $stmt->bind_param("i", $row['id']);
        $stmt->execute();
    }
}


?>