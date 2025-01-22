<?php
class User {
const STATUS_USER = 1;
const STATUS_ADMIN = 2;
protected $userName;
protected $passwd;
protected $fullName;
protected $email;
protected $date;
protected $status;

function __construct($userName, $fullName, $email, $passwd ){
$this->status=User::STATUS_USER;
$this->userName=$userName;
$this->fullName=$fullName;
$this->email=$email;
$this->passwd=password_hash($passwd, PASSWORD_DEFAULT);
$this->date = (new DateTime())->format('Y-m-d H:i:s');
}

Public function show() {
    echo "{$this->userName} {$this->fullName} {$this->email} status: {$this->status} {$this->date}";
}
Public function setUserName($userName) {
    $this->userName = $userName;
}
Public function getUserName() {
    return $this->userName;
}
Public function setFullName($fullName) {
    $this->fullName = $fullName;
}
Public function getFullName() {
    return $this->fullName;
}
Public function setStatus($status) {
    $this->status = $status;
}
Public function getStatus() {
    return $this->status;
}
Public function setEmail($email) {
    $this->email = $email;
}
Public function getEmail() {
    return $this->email;
}
Public function setDate($date) {
    $this->date = $date;
}
Public function getDate() {
    return $this->date;
}

static function getAllUsersFromDB($db) {
    $sql = "SELECT * FROM users";

    $result = $db->getMysqli()->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "{$row['id']} {$row['userName']} {$row['fullName']} {$row['email']} {$row['status']} {$row['date']}<br>";
        }
    } else {
        echo "Brak użytkowników w bazie danych.";
    }
}

 
public function toArray() {
$arr = [
    "userName" => $this->userName,
    "passwd" => $this->passwd,
    "fullName" => $this->fullName,
    "email" => $this->email,
    "date" => $this->date,
    "status" => $this->status
];
return $arr;
}

function saveDB($bd) {
    $sql_check = "SELECT * FROM users WHERE userName = '$this->userName' OR email = '$this->email'";
    $result = $bd->getMysqli()->query($sql_check);

    if ($result->num_rows > 0) {
        echo "<br><b>Błąd:</b> Użytkownik o podanej nazwie użytkownika lub e-mailu już istnieje.";
    } else {
        $sql = "INSERT INTO users (userName, fullName, email, passwd, status, date)
                VALUES ('$this->userName', '$this->fullName', '$this->email', '$this->passwd', '$this->status', '$this->date')";

        echo "<br><br><b>SQL:</b> $sql<br>";

        if ($bd->insert($sql)) {
            echo("<br>Rekord został zapisany w bazie danych.");
        } else {
            echo "Błąd zapisu do bazy." . $bd->getMysqli()->error;
        }
    }
}
}
?>