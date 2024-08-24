<?php
session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $accountID = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT userTBL.personID, userTBL.firstName, userTBL.middleName, userTBL.lastName, userTBL.suffixName, userTBL.role 
    FROM accountTBL INNER JOIN userTBL ON accountTBL.personID = userTBL.personID 
    WHERE accountTBL.userID = '$accountID' AND accountTBL.password = '$password'";

    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['middleName'] = $row['middleName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['suffixName'] = $row['suffixName'];
        $_SESSION['role'] = $row['role'];

        header("Location: ../Final HTML/DODesk-Dashboard.html");
        exit();
    } else {
        header("Location: ../Final HTML/DODesk-login.html"); //remember to change to index.php
        exit();
    }

    $conn->close();
} else {
    header("Location: ../Final HTML/DODesk-login.html"); //remember to change to index.php
    echo "did not login properly";
}
?>