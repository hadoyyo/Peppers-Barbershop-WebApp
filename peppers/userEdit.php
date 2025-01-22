<?php
session_start();
include_once __DIR__ . '/functions/includes.php';

$userName = $um->getLoggedInUserName($db, $sessionId);
$userId = $um->getLoggedInUser($db, $sessionId);

//czy zalogowany
if ($userId == -1) {
    header("Location: login.php");
    exit();
}
// User Edit functions
include_once __DIR__ . '/functions/userEdit.php';
?>

<!doctype html>
<html class="h-100" lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PEPPER's BARBERSHOP</title>
    <link rel="icon" href="img/icon.png" />
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/userEdit.css">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    
<!-- Nav -->
<?php
if ($user['status'] == 3 )
{
    include_once __DIR__ . '/views/navAdmin.php';
}
else
{
    include_once __DIR__ . '/views/navUser.php';
}
?>

    <body class="bg-black text-white mt-0" data-bs-spy="scroll" data-bs-target="#navScroll">
    <div class="container my-5 pt-6">
    <div class="row d-flex justify-content-center">
        <!-- Formularz edycji danych -->
        <div class="col-12 col-md-8 col-lg-6 d-flex flex-column justify-content-center align-items-center text-center pb-6">
            <h3 class="color-red">Edytuj dane:</h3>
            <form method="POST" class="w-100">
                <div class="form-group">
                    <label for="editField" class="color-red">Wybierz dane do edycji:</label>
                    <select class="form-control select-with-arrow w-75 mx-auto" id="editField" name="editField" required>
                        <option value="fullName">Imię i nazwisko</option>
                        <option value="userName">Nazwa użytkownika</option>
                        <option value="email">Email</option>
                        <option value="passwd">Hasło</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <label for="newValue" class="color-red">Nowe imię i nazwisko:</label>
                    <input type="text" class="form-control w-75 mx-auto" id="newValue" name="newValue" required>
                </div>
                
                <div id="currentPasswordField" class="form-group mt-3" style="display:none;">
                    <label for="currentPassword" class="color-red">Aktualne hasło:</label>
                    <input type="password" class="form-control w-75 mx-auto" id="currentPassword" name="currentPassword">
                </div>

                <button type="submit" class="btn custom-btn btn-xl mt-3 color-red">Zapisz zmiany</button>
            </form>

            <!-- Edit Alerts -->
            <?php include_once __DIR__ . '/functions/editAlerts.php'; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include_once __DIR__ . '/views/footer.php'; ?>

<script src="js/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            duration: 800
        });
    });

</script>

<!-- User Edit scripts -->
<script>
<?php include_once __DIR__ . '/scripts/userEditScripts.js'; ?>   
<?php include_once __DIR__ . '/scripts/navbar.js'; ?>
</script>

</body>

</html>
