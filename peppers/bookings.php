<?php
session_start();
// Includes
include_once __DIR__ . '/functions/includes.php';

$userName = $um->getLoggedInUserName($db, $sessionId);
$userId = $um->getLoggedInUser($db, $sessionId);

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

if ($user['status'] == 2 )
{
    echo "<script>
    window.location.href = 'barberBookings.php'; </script>";
}

if ($user['status'] == 3 )
{
    echo "<script>
    window.location.href = 'adminDashboard.php'; </script>";
}

if ($user['status'] != 1) {
    echo "<script>
    alert('Nie masz uprawnień do dokonywania rezerwacji.');
    window.location.href = 'dashboard.php';
    </script>";
    exit();
}

// User bookings functions
include_once __DIR__ . '/functions/userBookings.php';
?>



<!doctype html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PEPPER's BARBERSHOP</title>
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/userBookings.css">
    <link rel="icon" href="img/icon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-black text-white mt-0">
<!-- User navbar -->
<?php include_once __DIR__ . '/views/navUser.php'; ?>

<div class="anti-navbar" style="height: 3rem"></div>
<div style="height: 1rem"></div>
<div class="container my-5 pt-5">
    <ul class="nav nav-tabs mt-4 justify-content-center" id="reservationTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="umow-tab" data-toggle="tab" href="#umow" role="tab" aria-controls="umow" aria-selected="true">
                <span class="d-inline d-sm-none">Umów</span>
                <span class="d-none d-sm-inline">Umów</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="nadchodzace-tab" data-toggle="tab" href="#nadchodzace" role="tab" aria-controls="nadchodzace" aria-selected="false">
                <span class="d-inline d-sm-none">Nadchodz.</span>
                <span class="d-none d-sm-inline">Nadchodzące</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="zakonczone-tab" data-toggle="tab" href="#zakonczone" role="tab" aria-controls="zakonczone" aria-selected="false">
                <span class="d-inline d-sm-none">Zakończ.</span>
                <span class="d-none d-sm-inline">Zakończone</span>
            </a>
        </li>
    </ul>

    <div class="tab-content col-12 col-md-8 col-lg-7 d-flex flex-column mx-auto" id="reservationTabsContent">
    <div class="tab-pane fade show active" id="umow" role="tabpanel" aria-labelledby="umow-tab">
        <h2 class="text-center mt-4 color-red">Umów wizytę</h2>

        <!-- New Booking Form -->
        <?php include_once __DIR__ . '/views/newBookingForm.php'; ?>
        <br>
    </div>

    <div class="tab-pane fade" id="nadchodzace" role="tabpanel" aria-labelledby="nadchodzace-tab">
        <h2 class="text-center mt-4 color-red">Nadchodzące wizyty</h2>
        
        <!-- Nadchodzace functions -->
        <?php include_once __DIR__ . '/functions/userNadchodzace.php'; ?>
    </div>


    <div class="tab-pane fade" id="zakonczone" role="tabpanel" aria-labelledby="zakonczone-tab">
        <h2 class="text-center mt-4 color-red">Zakończone wizyty</h2>

        <!-- Zakonczone functions -->
        <?php include_once __DIR__ . '/functions/userZakonczone.php'; ?>
    </div>


    </div>

<!-- Footer -->
<?php include_once __DIR__ . '/views/footer.php'; ?>

<!-- User scripts -->
<script>
<?php include_once __DIR__ . '/scripts/userScripts.js'; ?>
<?php include_once __DIR__ . '/scripts/navbar.js'; ?>
</script>

</body>

</html>
