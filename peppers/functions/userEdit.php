<?php

$mysqli = $db->getMysqli();
$sql = "SELECT status FROM users WHERE id = '$userId'";
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();


$mysqli = $db->getMysqli();
$sql = "SELECT * FROM users WHERE id = '$userId'";
$result = $mysqli->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fieldToEdit = $_POST['editField'];
    $newValue = $_POST['newValue'];

    if ($fieldToEdit === 'userName' || $fieldToEdit === 'passwd' || $fieldToEdit === 'email') {
        $currentPassword = $_POST['currentPassword'];
        $user = $result->fetch_assoc();
        if (!password_verify($currentPassword, $user['passwd'])) {
            $error = "Nieprawidłowe hasło!";
        } else {
            if ($fieldToEdit === 'userName') {
                $sql_check_userName = "SELECT COUNT(*) AS count FROM users WHERE userName = ? AND id != ?";
                $stmt = $mysqli->prepare($sql_check_userName);
                $stmt->bind_param('si', $newValue, $userId);
                $stmt->execute();
                $result_userName = $stmt->get_result();
                $row_userName = $result_userName->fetch_assoc();
                if ($row_userName['count'] > 0) {
                    $error = "Nazwa użytkownika jest już zajęta.";
                }
            }
            elseif ($fieldToEdit === 'email') {
                $sql_check_email = "SELECT COUNT(*) AS count FROM users WHERE email = ? AND id != ?";
                $stmt = $mysqli->prepare($sql_check_email);
                $stmt->bind_param('si', $newValue, $userId);
                $stmt->execute();
                $result_email = $stmt->get_result();
                $row_email = $result_email->fetch_assoc();
                if ($row_email['count'] > 0) {
                    $error = "E-mail jest już przypisany do innego użytkownika.";
                } else {
                    $updateSql = "UPDATE users SET email = ? WHERE id = ?";
                    $stmt = $mysqli->prepare($updateSql);
                    $stmt->bind_param('si', $newValue, $userId);
                    $stmt->execute();
                    $success = "Dane zostały zaktualizowane.";
                }
            }

            if (!isset($error)) {
                if ($fieldToEdit === 'passwd') {
                    //zmiana hasła
                    $newValue = password_hash($newValue, PASSWORD_DEFAULT);
                }
                $updateSql = "UPDATE users SET $fieldToEdit = ? WHERE id = ?";
                $stmt = $mysqli->prepare($updateSql);
                $stmt->bind_param('si', $newValue, $userId);
                $stmt->execute();
                $success = "Dane zostały zaktualizowane.";
            }
        }
    } else {
        $updateSql = "UPDATE users SET $fieldToEdit = ? WHERE id = ?";
        $stmt = $mysqli->prepare($updateSql);
        $stmt->bind_param('si', $newValue, $userId);
        $stmt->execute();
        $success = "Dane zostały zaktualizowane.";
    }
}

?>