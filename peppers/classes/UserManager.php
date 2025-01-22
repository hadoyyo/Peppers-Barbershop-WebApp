<?php

class UserManager {
    function loginForm($errorMessage = '') {?>


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
                        <main class="mb-auto col-12" data-aos="fade-right">
                            <h1 class="color-red">Zaloguj się</h1><br>
                            <!-- Formularz logowania -->
                             <?php
                             if (!empty($errorMessage)) { ?>
                                <div style="border: 2px solid rgb(230, 29, 35); border-radius: 10px; display: flex; align-items: center; padding 10px;" data-aos="fade-up">
                                <div style="flex: 0 0 50px; display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: bold; color: rgb(230, 29, 35);"><i class="bi bi-x" style="font-size: 70px"></i></div>
                                <div style="flex: 1; color: rgb(230, 29, 35);" class="border-start">
                                    <b style="color: rgb(230, 29, 35);" class="ps-3 pe-1 pt-2"><?php echo $errorMessage; ?></b>
                                </div>
                                </div><br>
                            <?php }
                              ?>
                            <form class="row" action="login.php" method="post" id="loginForm">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label color-red">Nazwa użytkownika</label>
                                    <input id="username" name="login" class="form-control form-control-lg gradient1 border-black" style="color:black;outline: none;box-shadow: 0 0 0px; font-weight: bold;">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label color-red">Hasło</label>
                                    <input id="password" type="password" name="passwd" class="form-control form-control-lg gradient1 border-black" style="color:black;outline: none;box-shadow: 0 0 0px; font-weight: bold;">
                                </div>
                                <div class="mb-3 form-check py-3">
                                    <input id="rememberMe" type="checkbox" class="form-check-input background-red">
                                    <label class="form-check-label color-red" for="rememberMe">Zapamiętaj hasło</label>
                                </div>
                                <input type="submit" name="zaloguj" style="color:rgb(230, 29, 35)" class="btn custom-btn btn-xl mb-4" value="Zaloguj"></input>
                            </div>
                            <p class="color-red">Nie masz konta? <a class="link-fancy link-fancy-light" href="register.php">Zarejestruj się.</a></p>
                        </form>
                        </main>
                    </div>
                    <div class="col-12 col-md-5 col-lg-6 col-xl-7 gradient2"></div>
                </div>
            </div>
            <script src="js/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        AOS.init({
            duration: 800
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script>
    //zapamiętaj hasło
    document.addEventListener("DOMContentLoaded", function () {
        const usernameField = document.getElementById('username');
        const passwordField = document.getElementById('password');
        const rememberMeCheckbox = document.getElementById('rememberMe');

        const encryptionKey = "superSecretKey";

        const savedUsername = localStorage.getItem('rememberedUsername');
        const encryptedPassword = localStorage.getItem('rememberedPassword');

        if (savedUsername && encryptedPassword) {
            usernameField.value = savedUsername;

            const decryptedPassword = CryptoJS.AES.decrypt(encryptedPassword, encryptionKey).toString(CryptoJS.enc.Utf8);
            passwordField.value = decryptedPassword;
            rememberMeCheckbox.checked = true;
        }

        const form = document.getElementById('loginForm');
        form.addEventListener('submit', function () {
            if (rememberMeCheckbox.checked) {
                const encryptedPassword = CryptoJS.AES.encrypt(passwordField.value, encryptionKey).toString();

                localStorage.setItem('rememberedUsername', usernameField.value);
                localStorage.setItem('rememberedPassword', encryptedPassword);
            } else {
                localStorage.removeItem('rememberedUsername');
                localStorage.removeItem('rememberedPassword');
            }
        });
    });
</script>

        </body>
        </html>
        
    <?php }

    function login($db) {
        //sprawdza poprawność logowania
        //wynik - id użytkownika zalogowanego lub -1
        $args = [
            'login' => ['filter' => FILTER_VALIDATE_REGEXP,
                        'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']
            ],
            'passwd' => [
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => ['regexp' => '/.{4,}/']
            ]
        ];

        $dane = filter_input_array(INPUT_POST, $args);

        //czy użytkownik o loginie istnieje w tabeli users i czy podane hasło jest poprawne
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "users");

        if ($userId >= 0) { //poprawne dane
            session_start();

            $mysqli = $db->getMysqli();

            //usuń wszystkie wpisy historyczne dla użytkownika o $userId
            $sql_delete = "DELETE FROM logged_in_users WHERE userId = '$userId'";
            $mysqli->query($sql_delete);

            $currentDateTime = date("Y-m-d H:i:s");

            //pobierz id sesji i dodaj wpis do tabeli logged_in_users
            $sessionId = session_id();
            $sql_insert = "
                INSERT INTO logged_in_users (sessionId, userId, lastUpdate)
                VALUES ('$sessionId', '$userId', '$currentDateTime')
            ";
            $mysqli->query($sql_insert);
        } else {
            $errorMessage = "Nieprawidłowe dane!";
            $this->loginForm($errorMessage);
            return -1;
        }

        return $userId;
    }

    function logout($db) {
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    
        $sessionId = session_id();

        $mysqli = $db->getMysqli();

        //usuń wpis z id bieżącej sesji z tabeli logged_in_users
        $sql_delete = "DELETE FROM logged_in_users WHERE sessionId = '$sessionId'";
        $mysqli->query($sql_delete);
    
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_destroy();

    }
    
    function getLoggedInUser($db, $sessionId) {

        $mysqli = $db->getMysqli();
    
        $sql = "SELECT userId FROM logged_in_users WHERE sessionId = '$sessionId'";
        $result = $mysqli->query($sql);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['userId'];
        }

        return -1;
    }

    function deleteUserById($db, $userId) {
        if ($userId <= 0) {
            return false;
        }

        $sql = "DELETE FROM users WHERE id = '$userId'";

        if ($db->delete($sql)) {
            return true;
        } else {
            return false;
        }
    }

    function getLoggedInUserName($db, $sessionId) {
        $userId = $this->getLoggedInUser($db, $sessionId);
    
        //jeśli użytkownik jest zalogowany
        if ($userId > 0) {
            $mysqli = $db->getMysqli();
            $sql = "SELECT userName FROM users WHERE Id = '$userId'";
            $result = $mysqli->query($sql);
            
            //jeśli użytkownik o danym userId istnieje
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['userName']; // Zwróć nazwę użytkownika
            }
        }
    
        //jeśli użytkownik nie jest zalogowany lub nie znaleziono w tabeli users
        return null;
    }
    
   }
   

?>