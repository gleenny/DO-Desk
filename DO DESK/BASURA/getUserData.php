<?php
session_start();
header('Content-Type: application/json');
echo json_encode([
    'firstName' => $_SESSION['firstName'],
    'middleName' => $_SESSION['middleName'],
    'lastName' => $_SESSION['lastName'],
    'suffixName' => $_SESSION['suffixName']
    'role' => $_SESSION['role']
]);
?>