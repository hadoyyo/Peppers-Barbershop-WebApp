<?php
session_start();

// Includes
include_once __DIR__ . '/functions/includes.php';
include_once('classes/RegistrationForm.php');

$rf = new RegistrationForm();


$userId = $um->getLoggedInUser($db, $sessionId);

//czy zalogowany
if ($userId != -1) {
    $mysqli = $db->getMysqli();
    $sql = "SELECT * FROM users WHERE id = '$userId'";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();?>
    <html class="h-100" lang="pl">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
            <meta name="description" content="PEPPER's BARBERSHOP - Mistrzowie w swoim fachu">
            <meta name="author" content="">
            <meta name="HandheldFriendly" content="true">
            <title>PEPPER's BARBERSHOP</title>
            <link rel="icon" href="img/icon.png" />
            <link rel="stylesheet" href="css/theme.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>
        
        <body class="d-flex h-100 w-100" data-bs-spy="scroll" data-bs-target="#navScroll" style="background:black">

    <div class="h-100 container-fluid">
      <div class="h-100 row d-flex align-items-stretch">
        
          <div class="col-12 col-md-7 col-lg-6 col-xl-5 d-flex align-items-start flex-column px-vw-5">
          
            <header class="mb-auto py-vh-2 col-12">
              <a class="navbar-brand pe-md-4 fs-4 col-12 col-md-auto text-center" href="index.php"> 
                <img src="img/logo.png" class="icon">
              </a>
            </header>
            <main class="mb-auto col-12 text-center">
    <h1 class="color-red">Jesteś zalogowany</h1><br>
    
    <a href='login.php?akcja=wyloguj'
       class="btn custom-btn btn-xl my-3 color-red">
       Wyloguj  <i class="bi bi-box-arrow-right"></i>
    </a>

    <?php echo "<a href='index.php' class='btn custom-btn btn-xl ms-2 color-red'>Kontynuuj jako " . htmlspecialchars($user['userName']) . "<i class='bi bi-check-lg' style='font-size: 22px'></i></a>"; ?>
</main>
</div>
  <div class="col-12 col-md-5 col-lg-6 col-xl-7 gradient2"></div>
</div>
</div>

</body>

</html>

    <?php return;
}
else if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    $user = $rf->checkUser($db);
    if ($user !== NULL) {
      $user->saveDB($db);
      header("Location: successRegister.php");
      exit;
    }
}

$rf->render(); //wyświetl formularz rejestracji
