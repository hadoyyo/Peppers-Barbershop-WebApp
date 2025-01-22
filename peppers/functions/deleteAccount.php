<?php
//usunięcie konta
if (isset($_GET['deleteAccount']) && $_GET['deleteAccount'] == 'true') {
    if ($um->deleteUserById($db, $userId)) {
      
      $mysqli = $db->getMysqli();
      $sql = "DELETE FROM bookings WHERE clientId = '$userId'";
      $mysqli->query($sql);
      
        $um->logout($db);

        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Nie udało się usunąć konta.');</script>";
    }
}
?>