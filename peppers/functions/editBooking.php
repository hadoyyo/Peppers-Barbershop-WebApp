<?php
//pobranie id wizyty do edycji
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingId'])) {
    $bookingId = (int)$_POST['bookingId'];
} else {
    echo "<script>
                window.location.href = 'bookings.php';
            </script>";
    exit();
}

//pobranie danych wizyty
$mysqli = $db->getMysqli();
$query = "SELECT * FROM bookings WHERE id = ? AND clientId = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $bookingId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>
                alert('Wybierz wizytę ponownie.');
                window.location.href = 'bookings.php';
            </script>";
    exit();
}

$booking = $result->fetch_assoc();

include_once 'functions/functions.php';
$availableHours = ["09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30"];
?>