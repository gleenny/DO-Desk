<?php
include('../config.php');

$conn = new mysqli(HOST, DBUSERNAME, DBPASSWORD, DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

