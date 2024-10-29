<?php
session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "SELECT accountTBL.userID, accountTBL.active, userTBL.personID, userTBL.firstName, userTBL.middleName, userTBL.lastName, userTBL.role 
    FROM accountTBL INNER JOIN userTBL ON accountTBL.personID = userTBL.personID 
    WHERE accountTBL.username = ? AND accountTBL.password = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param('ss', $username, $password);    

    $username = base64_encode($_POST['username']);
    $password = base64_encode($_POST['password']);

    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['active'] = $row['active'];
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['middleName'] = $row['middleName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['role'] = $row['role'];
        
        if($_SESSION['active'] == "1"){
            //audit
            $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'Login user', NULL);";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();

            header("Location: ../final/index.php");
        }
        else{
            header("Location: ../final/DODesklogin.php");
        }
        
        exit();
    } else {
        header("Location: ../final/DODesklogin.php");
        exit();
    }

    $conn->close();
}
?>