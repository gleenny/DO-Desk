<?php
session_start(); // Start the session
unset($_SESSION['userID']);
unset($_SESSION['firstName']);
unset($_SESSION['middleName']);
unset($_SESSION['lastName']);
unset($_SESSION['suffixName']);
unset($_SESSION['role']);

header("Location: ../final/DODesklogin.php");
?>