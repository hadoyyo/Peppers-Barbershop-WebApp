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

include_once __DIR__ . '/functions/deleteAccount.php';

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


<!doctype html>
<html class="h-100" lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PEPPER's BARBERSHOP</title>
    <link rel="stylesheet" href="css/theme.css">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="img/icon.png" />
</head>

<body>
<!-- Admin navbar -->
<?php include_once __DIR__ . '/views/navAdmin.php'; ?>

    <body class="bg-black text-white mt-0" data-bs-spy="scroll" data-bs-target="#navScroll">
    <div class="container my-5 pt-6">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 d-flex flex-column pb-6" data-aos="fade-right">
        <h2 class="color-red"><i class="bi bi-person-fill"></i> Dane zalogowanego użytkownika</h2>
        <br>
        <!-- User Info -->
        <?php include_once __DIR__ . '/views/userInfo.php'; ?>
            </div>
        </div>
    </main>

<!-- Footer -->
<?php include_once __DIR__ . '/views/footer.php'; ?>

<!-- Scripts -->
<script src="js/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            duration: 800
        });
    });
</script>

<!-- Dashboard scripts -->
<script>
<?php include_once __DIR__ . '/scripts/dashboardScripts.js'; ?>
<?php include_once __DIR__ . '/scripts/navbar.js'; ?>
</script>

</body>

</html>