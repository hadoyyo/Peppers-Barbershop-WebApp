<?php
session_start();
include_once('../classes/User.php');
include_once "../classes/Baza.php";
include_once '../classes/UserManager.php';

$db = new Baza("localhost", "root", "", "peppers_database");
$um = new UserManager();
$sessionId = session_id();

$userId = $um->getLoggedInUser($db, $sessionId);

//czy zalogowany
if ($userId == -1) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingId'])) {
    $bookingId = (int)$_POST['bookingId'];
    $service = $_POST['service'];
    $barberId = $_POST['barber'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    //ceny i czasy usług
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

    //łączenie daty i godz.
    $startDate = "$date $time";
    $endDate = date("Y-m-d H:i", strtotime("$startDate + $duration minutes"));

    //dostępność terminu
    $mysqli = $db->getMysqli();
    $checkQuery = "
        SELECT * FROM bookings 
        WHERE barberId = ? 
        AND (startDate < ? AND endDate > ?) 
        AND id != ?
        AND status IN (0, 1, 5)";
    $stmt = $mysqli->prepare($checkQuery);
    $stmt->bind_param("issi", $barberId, $endDate, $startDate, $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
        alert('Nie udało się zaktualizować wizyty.');
        window.location.href = '../bookings.php';
        </script>";
    } else {
        //aktualizacja wizyty
        $updateQuery = "
            UPDATE bookings 
            SET startDate = ?, endDate = ?, barberId = ?, service = ?, price = ?, status = 0 
            WHERE id = ?";
        $stmt = $mysqli->prepare($updateQuery);
        $stmt->bind_param("ssisii", $startDate, $endDate, $barberId, $service, $price, $bookingId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>
                alert('Wizyta została pomyślnie zaktualizowana.');
                window.location.href = '../bookings.php';
            </script>";
        } else {
            echo "<script>
                    alert('Nie udało się zaktualizować wizyty.');
                    window.location.href = '../bookings.php';
                    </script>";
        }
    }
} else {
    echo "<script>
    alert('Niepoprawne żądanie.');
    window.location.href = '../bookings.php';
    </script>";
}
?>
