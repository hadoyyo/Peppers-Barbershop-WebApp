<?php
session_start();
include_once('../classes/User.php');
include_once "../classes/Baza.php";
include_once '../classes/UserManager.php';

$db = new Baza("localhost", "root", "", "peppers_database");
$um = new UserManager();
$sessionId = session_id();

$userName = $um->getLoggedInUserName($db, $sessionId);
$userId = $um->getLoggedInUser($db, $sessionId);

//czy zalogowany
if ($userId == -1) {
    header("Location: ../login.php");
    exit();
}

$mysqli = $db->getMysqli();
$sql = "SELECT status FROM users WHERE id = '$userId'";
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();

if ($user['status'] != 3) {
    echo "<script>
    alert('Nie masz odpowiednich uprawnień.');
    window.location.href = '../dashboard.php';
    </script>";
    exit();
}

if (isset($_POST['userId'])) {
    $userId = $mysqli->real_escape_string($_POST['userId']);

    $sql = "SELECT id, userName, fullName, email, status FROM users WHERE id = '$userId'";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    echo json_encode($user);
}
elseif (isset($_POST['bookingId'])) {
    $bookingId = $mysqli->real_escape_string($_POST['bookingId']);

    $sql = "SELECT id, clientId, barberId, startDate, endDate, service, price, status FROM bookings WHERE id = '$bookingId'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
        echo json_encode($booking);
    } else {
        echo json_encode(["error" => "Wizyta nie znaleziona"]);
    }
} else {
    echo "<script>
    alert('Niepoprawne żądanie.');
    window.location.href = '../bookings.php';
    </script>";
}
?>
