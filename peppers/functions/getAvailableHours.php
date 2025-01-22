<?php
include_once "../classes/Baza.php";

$db = new Baza("localhost", "root", "", "peppers_database");

if (isset($_GET['date']) && isset($_GET['barberId']) && isset($_GET['service'])) {
    $dateSelected = $_GET['date'];
    $barberId = (int)$_GET['barberId'];
    $service = $_GET['service'];

    $mysqli = $db->getMysqli();
    $hours = ["09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30"];

    // zajęte godziny
    $occupiedHoursQuery = "
        SELECT TIME(startDate) as start_time, TIME(endDate) as end_time 
        FROM bookings 
        WHERE DATE(startDate) = ? AND barberId = ? AND status IN (0, 1)";
    $stmt = $mysqli->prepare($occupiedHoursQuery);
    $stmt->bind_param("si", $dateSelected, $barberId);
    $stmt->execute();
    $result = $stmt->get_result();

    $occupiedIntervals = [];
    while ($row = $result->fetch_assoc()) {
        $occupiedIntervals[] = [
            'start' => $row['start_time'],
            'end' => $row['end_time']
        ];
    }

    $availableHours = [];
    foreach ($hours as $index => $hour) {
        $isAvailable = true;
        $hourStart = strtotime($hour);
        $hourEnd = strtotime("+30 minutes", $hourStart);

        // sprawdź, czy aktualny termin jest zajęty
        foreach ($occupiedIntervals as $interval) {
            $intervalStart = strtotime($interval['start']);
            $intervalEnd = strtotime($interval['end']);

            if (($hourStart < $intervalEnd) && ($hourEnd > $intervalStart)) {
                $isAvailable = false;
                break;
            }
        }

        // jeśli usługa trwa godzinę, sprawdź dostępność następnego terminu
        if ($isAvailable && ($service === 'Strzyżenie włosów i zarostu' || $service === 'Repigmentacja zarostu i włosów' || $service === 'Farbowanie')) {
            if ($index + 1 >= count($hours)) {
                $isAvailable = false;
            } else {
                $nextHourStart = strtotime($hours[$index + 1]);
                $nextHourEnd = strtotime("+30 minutes", $nextHourStart);

                foreach ($occupiedIntervals as $interval) {
                    $intervalStart = strtotime($interval['start']);
                    $intervalEnd = strtotime($interval['end']);

                    if (($nextHourStart < $intervalEnd) && ($nextHourEnd > $intervalStart)) {
                        $isAvailable = false;
                        break;
                    }
                }
            }
        }

        if ($isAvailable) {
            $availableHours[] = $hour;
        }
    }

    echo json_encode($availableHours);
} else {
    echo "<script>
    window.location.href = '../bookings.php';
    </script>";
}
?>
