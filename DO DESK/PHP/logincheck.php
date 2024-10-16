<?php
session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $query = "SELECT accountTBL.userID, userTBL.personID, userTBL.firstName, userTBL.middleName, userTBL.lastName, userTBL.role 
    FROM accountTBL INNER JOIN userTBL ON accountTBL.personID = userTBL.personID 
    WHERE accountTBL.username = ? AND accountTBL.password = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param('ss', $username, $password);    

    $username = $_POST['username'];
    $password = base64_encode($_POST['password']);

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['middleName'] = $row['middleName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['role'] = $row['role'];

        //if($_SESSION['role'] === "Officer"){
            header("Location: ../final/index.php");
        //}
        
        exit();
    } else {
        header("Location: ../final/DODesk-login.php"); //remember to change to index.php
        exit();
    }

    $conn->close();
} else {
    header("Location: ../final/DODesk-login.php"); //remember to change to index.php
    echo "did not login properly";
}
?>