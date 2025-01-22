<?php
class Baza {
    private $mysqli; // uchwyt do BD

    public function getLoggedInUserName() {
        $query = "SELECT userId FROM logged_in_users LIMIT 1";
        $result = $this->mysqli->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            $userId = $row['userId'];

            $userQuery = "SELECT userName FROM users WHERE Id = $userId";
            $userResult = $this->mysqli->query($userQuery);

            if ($userResult && $userRow = $userResult->fetch_assoc()) {
                return $userRow['userName'];
            }
        }

        return null;
    }

    public function __construct($serwer, $user, $pass, $baza) {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        /* sprawdz połączenie */
        if ($this->mysqli->connect_errno) {
            printf("Nie udało sie połączenie z serwerem: %s\n", $this->mysqli->connect_error);
            exit();
        }
        /* zmien kodowanie na utf8 */
        if ($this->mysqli->set_charset("utf8")) {
            // udało się zmienić kodowanie
        }
    }

    function __destruct() {
        $this->mysqli->close();
    }

    public function select($sql, $pola) {
        $tresc = "";
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola); //ile pól
            $ile = $result->num_rows; //ile wierszy
            // pętla po wyniku zapytania $results
            $tresc .= "<table><tbody>";
            while ($row = $result->fetch_object()) {
                $tresc .= "<tr>";
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc .= "<td>" . $row->$p . "</td>";
                }
                $tresc .= "</tr>";
            }
            $tresc .= "</table></tbody>";
            $result->close(); /* zwolnij pamięć */
        }
        return $tresc;
    }

    public function delete($sql) {
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($sql) {
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function getMysqli() {
        return $this->mysqli;
    }

    public function selectUser($login, $passwd, $tabela) {
        //parametry $login, $passwd , $tabela – nazwa tabeli z użytkownikami
        //wynik – id użytkownika lub -1 jeśli dane logowania nie są poprawne
        $id = -1;
        $sql = "SELECT * FROM $tabela WHERE userName='$login'";
        if ($result = $this->mysqli->query($sql)) {
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object();
                $hash = $row->passwd; //pobierz zahaszowane hasło użytkownika
                //sprawdź czy pobrane hasło pasuje do tego z tabeli bazy danych:
                if (password_verify($passwd, $hash))
                    $id = $row->id;
            }
        }
        return $id; //id zalogowanego użytkownika(>0) lub -1
    }

}
