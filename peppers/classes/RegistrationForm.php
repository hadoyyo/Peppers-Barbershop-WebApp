<?php
class RegistrationForm {
    protected $user;
    public $message = ""; // Pole klasy na komunikaty

    function render() { ?>
        <html class="h-100" lang="pl">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
            <meta name="description" content="PEPPER's BARBERSHOP - Mistrzowie w swoim fachu">
            <title>PEPPER's BARBERSHOP</title>
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
                        <main class="mb-auto col-12">
                            <h1 class="color-red">Zarejestruj się</h1><br>
                            <?php echo $this->message; ?>
                            <form class="row" action="register.php" method="post">
                            <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label color-red">Nazwa użytkownika</label>
                                <input class="form-control form-control-lg gradient1 border-black" name="userName" style="color:black;outline: none;box-shadow: 0 0 0px; font-weight: bold;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label color-red">Imię i nazwisko</label>
                                <input class="form-control form-control-lg gradient1 border-black" name="fullName" style="color:black;outline: none;box-shadow: 0 0 0px; font-weight: bold;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label color-red">E-mail</label>
                                <input type="email" class="form-control form-control-lg gradient1 border-black" name="email" style="color:black;outline: none;box-shadow: 0 0 0px; font-weight: bold;">
                            </div>
                            <div class="mb-4">
                                <label class="form-label color-red">Hasło</label>
                                <input type="password" class="form-control form-control-lg gradient1 border-black" name="passwd" style="color:black;outline: none;box-shadow: 0 0 0px; font-weight: bold;">
                            </div>
                            <input type="submit" name="submit" style="color:rgb(230, 29, 35)" class="btn custom-btn btn-xl mb-4" value="Zarejestruj się"></input>
                            </div>
                            <p class="color-red">Masz już konto? <a class="link-fancy link-fancy-light" href="login.php">Zaloguj się.</a></p>
                            </form>
                        </main>
                    </div>
                    <div class="col-12 col-md-5 col-lg-6 col-xl-7 gradient2"></div>
                </div>
            </div>
            <script src="js/aos.js"></script>
            <script>
                AOS.init({
                duration: 800, 
                });
            </script>
        </body>
        </html>
    <?php }

function checkUser($db) {
    $args = [
        'userName' => [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']
        ],
        'fullName' => [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/^[A-Za-ząęłńśćźżó ]{2,50}$/']
        ],
        'email' => FILTER_VALIDATE_EMAIL,
        'passwd' => [
            'filter' => FILTER_VALIDATE_REGEXP,
            'options' => ['regexp' => '/.{5,}/']
        ]
    ];

    $dane = filter_input_array(INPUT_POST, $args);

    $errors = "";
    //sprawdź błędy
    foreach ($dane as $key => $value) {
        if ($value === false || $value === null) {
            if ($key == "userName") {
                $errors .= "Nazwa użytkownika powinna zawierać od 2 do 25 znaków. ";
            }
            if ($key == "fullName") {
                $errors .= "Imię i nazwisko musi zawierać tylko litery. ";
            }
            if ($key == "email") {
                $errors .= "E-mail niezgodny z wymogami. ";
            }
            if ($key == "passwd") {
                $errors .= "Hasło musi zawierać minimum 5 znaków. ";
            }
        }
    }

    //jeśli brak błędów sprawdź czy userName lub email nie istnieją już w bazie
    if ($errors === "") {
        $mysqli = $db->getMysqli();
        
        $userName = $dane['userName'];
        $email = $dane['email'];
        
        $sql_check_userName = "SELECT COUNT(*) AS count FROM users WHERE userName = '$userName'";
        $result_userName = $mysqli->query($sql_check_userName);
        $row_userName = $result_userName->fetch_assoc();
        
        $sql_check_email = "SELECT COUNT(*) AS count FROM users WHERE email = '$email'";
        $result_email = $mysqli->query($sql_check_email);
        $row_email = $result_email->fetch_assoc();

        //jeżeli userName lub email istnieją już w bazie
        if ($row_userName['count'] > 0) {
            $errors .= "Nazwa użytkownika jest już zajęta. ";
        }
        if ($row_email['count'] > 0) {
            $errors .= "E-mail jest już przypisany do innego użytkownika. ";
        }

        if ($errors === "") {
            //tworzenie użytkownika jeśli nie ma błędów
            $this->user = new User($dane['userName'], $dane['fullName'], $dane['email'], $dane['passwd']);
        } else {
            $this->message = "
<div style='border: 2px solid rgb(230, 29, 35); border-radius: 10px; display: flex; align-items: center; padding: 10px;' data-aos='fade-up'>
    <div style='flex: 0 0 50px; display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: bold; color: rgb(230, 29, 35);'><i class='bi bi-x' style='font-size: 70px;'></i></div>
    <div style='flex: 1; color: rgb(230, 29, 35);' class='border-start'>
        <b style='color: rgb(230, 29, 35);' class='ps-3 pe-1'>Nieprawidłowe dane!</b>
        <p style='color: rgb(230, 29, 35);' class='ps-3 pe-1'>$errors</p>
    </div>
</div>
<br>";
            $this->user = NULL;
        }
    } else {
        $this->message = "
<div style='border: 2px solid rgb(230, 29, 35); border-radius: 10px; display: flex; align-items: center; padding: 10px;' data-aos='fade-up'>
    <div style='flex: 0 0 50px; display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: bold; color: rgb(230, 29, 35);'><i class='bi bi-x' style='font-size: 70px;'></i></div>
    <div style='flex: 1; color: rgb(230, 29, 35);' class='border-start'>
        <b style='color: rgb(230, 29, 35);' class='ps-3 pe-1'>Nieprawidłowe dane!</b>
        <p style='color: rgb(230, 29, 35);' class='ps-3 pe-1'>$errors</p>
    </div>
</div>
<br>";
        $this->user = NULL;
    }

    return $this->user;
}

}
