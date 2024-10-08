<?php


$host = "localhost:3306"; //problema to if online na 
$dbusername = "root";
$dbpassword = "";
$dbname = "dodesk";

$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

