<?php
session_start();
// Includes
include_once __DIR__ . '/functions/includes.php';

$userName = $um->getLoggedInUserName($db, $sessionId);
$userId = $um->getLoggedInUser($db, $sessionId);

// Management functions
include_once 'functions/adminFunctions.php';
include_once 'functions/functions.php';

?>

<!doctype html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PEPPER's BARBERSHOP</title>
    <link rel="icon" href="img/icon.png" />
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/management.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.3.1/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-black text-white mt-0">

<!-- Admin navbar -->
<?php include_once __DIR__ . '/views/navAdmin.php'; ?>

<div class="anti-navbar" style="height: 3rem"></div>
<div style="height: 1rem"></div>
<div class="container my-5 pt-5">
<ul class="nav nav-tabs mt-4 justify-content-center" id="reservationTabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link" id="uzytkownicy-tab" data-toggle="tab" href="#uzytkownicy" role="tab" aria-controls="uzytkownicy" aria-selected="true">
            <span class="d-inline d-sm-none">Użytkownicy</span>
            <span class="d-none d-sm-inline">Użytkownicy</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="wizyty-tab" data-toggle="tab" href="#wizyty" role="tab" aria-controls="wizyty" aria-selected="false">
            <span class="d-inline d-sm-none">Wizyty</span>
            <span class="d-none d-sm-inline">Wizyty</span>
        </a>
    </li>
</ul>
<div class="tab-content col-12 col-md-8 col-lg-7 d-flex flex-column mx-auto" id="reservationTabsContent">
    <!-- Tab: Użytkownicy -->
    <div class="tab-pane fade show active" id="uzytkownicy" role="tabpanel" aria-labelledby="uzytkownicy-tab">
    <h2 class="text-center mt-4 color-red mb-4">Użytkownicy</h2>

    <form method="GET" action="">
    <div class="row g-3 justify-content-center align-items-center">
        <div class="col-12 col-md-3">
            <input type="text" name="filter_username" class="form-control form-control-lg" placeholder="Nazwa użytkownika" value="<?php echo isset($_GET['filter_username']) ? htmlspecialchars($_GET['filter_username']) : ''; ?>">
        </div>
        <div class="col-12 col-md-3">
            <input type="text" name="filter_fullname" class="form-control form-control-lg" placeholder="Imię i nazwisko" value="<?php echo isset($_GET['filter_fullname']) ? htmlspecialchars($_GET['filter_fullname']) : ''; ?>">
        </div>
        <div class="col-12 col-md-3">
            <input type="text" name="filter_email" class="form-control form-control-lg" placeholder="E-mail" value="<?php echo isset($_GET['filter_email']) ? htmlspecialchars($_GET['filter_email']) : ''; ?>">
        </div>
        <div class="col-12 col-md-3">
            <select name="filter_status" class="form-control form-control-lg select-with-arrow">
                <option value="">Status</option>
                <option value="1" <?php echo (isset($_GET['filter_status']) && $_GET['filter_status'] == "1") ? 'selected' : ''; ?>>Klient</option>
                <option value="2" <?php echo (isset($_GET['filter_status']) && $_GET['filter_status'] == "2") ? 'selected' : ''; ?>>Barber</option>
                <option value="3" <?php echo (isset($_GET['filter_status']) && $_GET['filter_status'] == "3") ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <div class="col-12 d-flex justify-content-between">
    <button type="button" class="btn custom-btn btn-lg color-red me-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="bi bi-plus-lg"></i> Dodaj
    </button>
    <div class="d-flex justify-content-end align-items-end">
        <button type="submit" class="btn custom-btn btn-lg me-2 color-red">
            <i class="bi bi-search"></i> Filtruj
        </button>
        <a href="?" class="btn custom-btn btn-lg">
            <i class="bi bi-x-lg"></i> Reset
        </a>
    </div>
    </div>
    </div>
    </form>

<!-- Users functions -->
<?php include_once __DIR__ . '/functions/adminUsers.php'; ?>

<!-- Tab: Wizyty -->
    <div class="tab-pane fade" id="wizyty" role="tabpanel" aria-labelledby="wizyty-tab">
    <h2 class="text-center mt-4 color-red mb-4">Wizyty</h2>

    <form method="GET" action="">
        <div class="row g-3 justify-content-center align-items-center">
            <div class="col-12 col-md-3">
                <select name="filter_service" class="form-control form-control-lg select-with-arrow">
                    <option value="">Usługa</option>
                    <option value="Strzyżenie włosów" <?php echo (isset($_GET['filter_service']) && $_GET['filter_service'] == "Strzyżenie włosów") ? 'selected' : ''; ?>>Strzyżenie włosów</option>
                    <option value="Strzyżenie zarostu" <?php echo (isset($_GET['filter_service']) && $_GET['filter_service'] == "Strzyżenie zarostu") ? 'selected' : ''; ?>>Strzyżenie zarostu</option>
                    <option value="Strzyżenie włosów i zarostu" <?php echo (isset($_GET['filter_service']) && $_GET['filter_service'] == "Strzyżenie włosów i zarostu") ? 'selected' : ''; ?>>Strzyżenie włosów i zarostu</option>
                    <option value="Repigmentacja zarostu" <?php echo (isset($_GET['filter_service']) && $_GET['filter_service'] == "Repigmentacja zarostu") ? 'selected' : ''; ?>>Repigmentacja zarostu</option>
                    <option value="Repigmentacja zarostu i włosów" <?php echo (isset($_GET['filter_service']) && $_GET['filter_service'] == "Repigmentacja zarostu i włosów") ? 'selected' : ''; ?>>Repigmentacja zarostu i włosów</option>
                    <option value="Farbowanie" <?php echo (isset($_GET['filter_service']) && $_GET['filter_service'] == "Farbowanie") ? 'selected' : ''; ?>>Farbowanie</option>
                </select>
            </div>
            <div class="col-12 col-md-3">
            <select name="filter_price" class="form-control form-control-lg select-with-arrow">
                <option value="">Cena</option>
                <option value="35" <?php echo (isset($_GET['filter_price']) && $_GET['filter_price'] == "35") ? 'selected' : ''; ?>>35 zł</option>
                <option value="60" <?php echo (isset($_GET['filter_price']) && $_GET['filter_price'] == "60") ? 'selected' : ''; ?>>60 zł</option>
                <option value="70" <?php echo (isset($_GET['filter_price']) && $_GET['filter_price'] == "70") ? 'selected' : ''; ?>>70 zł</option>
                <option value="100" <?php echo (isset($_GET['filter_price']) && $_GET['filter_price'] == "100") ? 'selected' : ''; ?>>100 zł</option>
                <option value="110" <?php echo (isset($_GET['filter_price']) && $_GET['filter_price'] == "110") ? 'selected' : ''; ?>>110 zł</option>
                <option value="130" <?php echo (isset($_GET['filter_price']) && $_GET['filter_price'] == "130") ? 'selected' : ''; ?>>130 zł</option>
            </select>
            </div>
            <div class="col-12 col-md-3">
            <select name="filter_barber" class="form-control form-control-lg select-with-arrow">
                <option value="">Barber</option>
                <?php
                $barberQuery = "SELECT id, fullName FROM users WHERE status = 2";
                $barberResult = $mysqli->query($barberQuery);
                while ($barberRow = $barberResult->fetch_assoc()) {
                    echo "<option value='" . $barberRow['id'] . "' " . (isset($_GET['filter_barber']) && $_GET['filter_barber'] == $barberRow['id'] ? 'selected' : '') . ">" . htmlspecialchars($barberRow['fullName']) . "</option>";
                }
                ?>
            </select>
            </div>
            <div class="col-12 col-md-3">
            <select name="filter_status2" class="form-control form-control-lg select-with-arrow">
                <option value="">Status</option>
                <option value="6" <?php echo (isset($_GET['filter_status2']) && $_GET['filter_status2'] == "6") ? 'selected' : ''; ?>>Oczekuje na potwierdzenie</option>
                <option value="1" <?php echo (isset($_GET['filter_status2']) && $_GET['filter_status2'] == "1") ? 'selected' : ''; ?>>Potwierdzona</option>
                <option value="2" <?php echo (isset($_GET['filter_status2']) && $_GET['filter_status2'] == "2") ? 'selected' : ''; ?>>Odrzucona przez barbera</option>
                <option value="3" <?php echo (isset($_GET['filter_status2']) && $_GET['filter_status2'] == "3") ? 'selected' : ''; ?>>Anulowana</option>
                <option value="4" <?php echo (isset($_GET['filter_status2']) && $_GET['filter_status2'] == "4") ? 'selected' : ''; ?>>Zakończona</option>
                <option value="5" <?php echo (isset($_GET['filter_status2']) && $_GET['filter_status2'] == "5") ? 'selected' : ''; ?>>W trakcie</option>
            </select>

            </div>
                <div class="d-flex justify-content-end align-items-end">
                    <button type="submit" class="btn custom-btn btn-lg me-2 color-red">
                        <i class="bi bi-search"></i> Filtruj
                    </button>
                    <a href="?" class="btn custom-btn btn-lg">
                        <i class="bi bi-x-lg"></i> Reset
                    </a>
                </div>
        </div>
    </form>

    <!-- Bookings functions -->
    <?php include_once __DIR__ . '/functions/adminBookings.php'; ?>

</div>
</div>

<!-- Modals -->
<?php include_once __DIR__ . '/views/adminModals.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Footer -->
<?php include_once __DIR__ . '/views/footer.php'; ?>

<!-- Management scripts -->
<script>
<?php include_once __DIR__ . '/scripts/managementScripts.js'; ?>
<?php include_once __DIR__ . '/scripts/navbar.js'; ?>
</script>

</body>

</html>