<?php

session_start();
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT userTBL.personID, userTBL.firstName, userTBL.middleName, userTBL.lastName, userTBL.suffixName, userTBL.role, accountTBL.password 
        FROM accountTBL INNER JOIN userTBL ON accountTBL.personID = userTBL.personID 
        WHERE accountTBL.email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Directly compare the password in plain text
        if ($password === $row['password']) { // Direct comparison
            $_SESSION['userID'] = $row['personID'];
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['middleName'] = $row['middleName'];
            $_SESSION['lastName'] = $row['lastName'];
            $_SESSION['suffixName'] = $row['suffixName'];
            $_SESSION['role'] = $row['role'];

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'invalid_password']);
        }
    } else {
        echo json_encode(['status' => 'user_not_found']);
    }

    $stmt->close();
    $conn->close();
}






/*session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT userTBL.personID, userTBL.firstName, userTBL.middleName, userTBL.lastName, userTBL.suffixName, userTBL.role 
    FROM accountTBL INNER JOIN userTBL ON accountTBL.personID = userTBL.personID 
    WHERE accountTBL.email = '$email' AND accountTBL.password = '$password'";

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
} */
?>