<?php

include_once('classes/User.php');
include_once "classes/Baza.php";
include_once 'classes/UserManager.php';

$db = new Baza("localhost", "root", "", "peppers_database");
$um = new UserManager();
$sessionId = session_id();

?>