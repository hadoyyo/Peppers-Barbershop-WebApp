<?php

//czy zalogowany
if ($userId == -1) {
    header("Location: login.php");
    exit();
}

//sprawdź status
$mysqli = $db->getMysqli();
$sql = "SELECT status FROM users WHERE id = '$userId'";
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();

if ($user['status'] == 1 )
{
    echo "<script>
    window.location.href = 'dashboard.php'; </script>";
}

if ($user['status'] != 3) {
    echo "<script>
    alert('Nie masz odpowiednich uprawnień.');
    window.location.href = 'dashboard.php';
    </script>";
    exit();
}

$mysqli = $db->getMysqli();
$sql = "SELECT * FROM users WHERE id = '$userId'";
$result = $mysqli->query($sql);
?>

<?php
$upArrow = '<i class="bi bi-arrow-up"></i>';
$downArrow = '<i class="bi bi-arrow-down"></i>';

$sortColumn = isset($_GET['sort_column']) ? $_GET['sort_column'] : 'id';
$sortOrder = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';

$icons = [
    'ASC' => $upArrow,
    'DESC' => $downArrow
];


//usuwanie użytkownika
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteUser'])) {
    $userIdToDelete = $mysqli->real_escape_string($_POST['userId']);

    $deleteQuery = "DELETE FROM users WHERE id = '$userIdToDelete'";
    if ($mysqli->query($deleteQuery)) {
        echo "<script>
            alert('Użytkownik został pomyślnie usunięty.');
            window.location.href = 'management.php'; // Odświeżenie strony
        </script>";
    } else {
        echo "<script>
            alert('Wystąpił błąd podczas usuwania użytkownika.');
        </script>";
    }
}
//usuwanie wizyty
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteBooking'])) {
    $bookingIdToDelete = $mysqli->real_escape_string($_POST['bookingId']);

    $deleteQuery = "DELETE FROM bookings WHERE id = '$bookingIdToDelete'";
    if ($mysqli->query($deleteQuery)) {
        echo "<script>
            alert('Wizyta został pomyślnie usunięta.');
            window.location.href = 'management.php'; // Odświeżenie strony
        </script>";
    } else {
        echo "<script>
            alert('Wystąpił błąd podczas usuwania wizyty.');
        </script>";
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    $status = $_POST['status'];

    $args = [
        'userName' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/',
        'fullName' => '/^[A-Za-ząęłńśćźżó ]{2,50}$/',
        'email' => FILTER_VALIDATE_EMAIL,
        'passwd' => '/.{5,}/'
    ];

    $validatedUserName = filter_var($userName, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $args['userName']]]);
    $validatedFullName = filter_var($fullName, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $args['fullName']]]);
    $validatedEmail = filter_var($email, $args['email']);

    //jeżeli podano hasło -> walidacja hasła
    $validatedPasswd = $passwd ? filter_var($passwd, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $args['passwd']]]) : true;

    if ($validatedUserName && $validatedFullName && $validatedEmail && $validatedPasswd) {
        //czy userName lub email istnieje już w bazie
        $sql = "SELECT id, status FROM users WHERE (userName = ? OR email = ?) AND id != ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssi", $userName, $email, $userId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Podana nazwa użytkownika lub e-mail są już przypisane do innego konta.');</script>";
        } else {
            $sql = "SELECT status FROM users WHERE id = ?";
            $currentStatusStmt = $mysqli->prepare($sql);
            $currentStatusStmt->bind_param("i", $userId);
            $currentStatusStmt->execute();
            $currentStatusStmt->bind_result($currentStatus);
            $currentStatusStmt->fetch();
            $currentStatusStmt->close();

            if ($passwd) {
                $hashedPasswd = password_hash($passwd, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET userName = ?, fullName = ?, email = ?, passwd = ?, status = ? WHERE id = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("ssssii", $userName, $fullName, $email, $hashedPasswd, $status, $userId);
            } else {
                $sql = "UPDATE users SET userName = ?, fullName = ?, email = ?, status = ? WHERE id = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("sssii", $userName, $fullName, $email, $status, $userId);
            }

            if ($stmt->execute()) {
                if ($currentStatus != $status) {
                    $deleteBookingsSql = "DELETE FROM bookings WHERE clientId = ? OR barberId = ?";
                    $deleteStmt = $mysqli->prepare($deleteBookingsSql);
                    $deleteStmt->bind_param("ii", $userId, $userId);
                    if ($deleteStmt->execute()) {
                        echo "<script>alert('Dane użytkownika zostały zaktualizowane. Wizyty użytkownika zostały usunięte ze względu na zmianę statusu.'); window.location.href = window.location.href;</script>";
                    } else {
                        echo "<script>alert('Dane użytkownika zostały zaktualizowane.');</script>";
                    }
                    $deleteStmt->close();
                } else {
                    echo "<script>alert('Dane użytkownika zostały zaktualizowane.'); window.location.href = window.location.href;</script>";
                }
            } else {
                echo "<script>alert('Wystąpił błąd podczas aktualizacji danych użytkownika.');</script>";
            }
            $stmt->close();
        }
        $stmt->close();
    } else {
        echo "<script>alert('Wprowadzone dane są niepoprawne.');</script>";
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userName'], $_POST['fullName'], $_POST['email'], $_POST['passwd'], $_POST['status'])) {
    $userName = $_POST['userName'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $passwd = $_POST['passwd'];
    $status = $_POST['status'];

    //walidacja danych użytkownika
    $args = [
        'userName' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/',
        'fullName' => '/^[A-Za-ząęłńśćźżó ]{2,50}$/',
        'email' => FILTER_VALIDATE_EMAIL,
        'passwd' => '/.{5,}/'
    ];

    $validatedUserName = filter_var($userName, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $args['userName']]]);
    $validatedFullName = filter_var($fullName, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $args['fullName']]]);
    $validatedEmail = filter_var($email, $args['email']);
    $validatedPasswd = filter_var($passwd, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $args['passwd']]]);

    if ($validatedUserName && $validatedFullName && $validatedEmail && $validatedPasswd) {
        $sql = "SELECT id FROM users WHERE userName = ? OR email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $userName, $email);
        $stmt->execute();
        $stmt->store_result();
        $currentDate = (new DateTime())->format('Y-m-d H:i:s');

        if ($stmt->num_rows > 0) {
            echo "<script>alert('Podana nazwa użytkownika lub e-mail są już przypisane do innego konta.');</script>";
        } else {
            $hashedPasswd = password_hash($passwd, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (userName, fullName, email, passwd, status, date) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssssis", $userName, $fullName, $email, $hashedPasswd, $status, $currentDate);

            if ($stmt->execute()) {
                echo "<script>alert('Użytkownik został dodany pomyślnie.'); window.location.href = window.location.href;</script>";
            } else {
                echo "<script>alert('Wystąpił błąd podczas dodawania użytkownika.');</script>";
            }
        }

        $stmt->close();
    } else {
        echo "<script>alert('Wprowadzone dane są niepoprawne lub hasło jest za krótkie.');</script>";
    }
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookingId'])) {
    $bookingId = (int)$_POST['bookingId'];
    $clientId = (int)$_POST['clientId'];
    $service = $_POST['service'];
    $barberId = (int)$_POST['barber'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];

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

    $startDate = date("Y-m-d H:i:s", strtotime("$date $time"));
    $endDate = date("Y-m-d H:i:s", strtotime("$startDate + $duration minutes"));

    $mysqli = $db->getMysqli();

    $clientCheckQuery = "SELECT id FROM users WHERE id = ? AND status = 1";
    $stmt = $mysqli->prepare($clientCheckQuery);
    if ($stmt === false) {
        die("Prepare failed (client validation): " . $mysqli->error);
    }
    $stmt->bind_param("i", $clientId);
    $stmt->execute();
    $clientResult = $stmt->get_result();

    if ($clientResult->num_rows === 0) {
        echo "<script>
            alert('Nieprawidłowe ID klienta.');
            window.location.href = 'management.php';
        </script>";
        exit();
    }

    $checkQuery = "
        SELECT * FROM bookings 
        WHERE barberId = ? 
        AND (startDate < ? AND endDate > ?) 
        AND id != ?";
    $stmt = $mysqli->prepare($checkQuery);
    $stmt->bind_param("issi", $barberId, $endDate, $startDate, $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>
            alert('Wybrany termin jest niedostępny.');
            window.location.href = 'management.php';
        </script>";
    } else {
        $updateQuery = "
            UPDATE bookings 
            SET startDate = ?, endDate = ?, barberId = ?, service = ?, price = ?, status = ?, clientId = ? 
            WHERE id = ?";
        $stmt = $mysqli->prepare($updateQuery);
        if ($stmt === false) {
            echo "<script>
                alert('Nie udało się zaktualizować wizyty.');
                window.location.href = 'management.php';
            </script>";
        }
        $stmt->bind_param("ssisiiii", $startDate, $endDate, $barberId, $service, $price, $status, $clientId, $bookingId);

        if ($stmt->execute()) {
            echo "<script>
                alert('Wizyta została pomyślnie zaktualizowana.');
                window.location.href = 'management.php';
            </script>";
        } else {
            echo "<script>
                alert('Nie udało się zaktualizować wizyty.');
                window.location.href = 'management.php';
            </script>";
        }
    }
}

$availableHours = ["09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30"];

?>
