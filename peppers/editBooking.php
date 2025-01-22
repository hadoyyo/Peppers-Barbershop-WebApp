<?php
session_start();
// Includes
include_once __DIR__ . '/functions/includes.php';

$userId = $um->getLoggedInUser($db, $sessionId);

//czy zalogowany
if ($userId == -1) {
    header("Location: login.php");
    exit();
}

// Edit Booking functions
include_once __DIR__ . '/functions/editBooking.php';
?>

<!doctype html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PEPPER's BARBERSHOP</title>
    <link rel="icon" href="img/icon.png" />
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/editBooking.css">
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
    <div class="tab-content col-12 col-md-8 col-lg-7 d-flex flex-column mx-auto" id="reservationTabsContent">
    <div class="tab-pane fade show active" id="umow" role="tabpanel" aria-labelledby="umow-tab">
        <h2 class="text-center mt-4 color-red">Edytuj szczegóły wizyty</h2>

        <!-- Edit Booking Form -->
        <?php include_once __DIR__ . '/views/editBookingForm.php'; ?>
        <br>
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