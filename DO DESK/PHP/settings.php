<?php 

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //change password
    if($_POST['requestType'] === "changePassword"){
        $oldPassword = base64_encode($_POST["oldPassword"]);
        $newPassword = base64_encode($_POST["newPassword"]);

        $userID = $_SESSION["userID"];

        $verifyQuery = "SELECT `accountTBL`.*
            FROM `accountTBL`
            WHERE `accountTBL`.`password` LIKE '$oldPassword'
            AND `accountTBL`.`userID` LIKE '$userID'";

        $check = $conn->prepare($verifyQuery);
        $check->execute();
        $result = $check->get_result();
        if ($result->num_rows == 1) {
            $changeQuery = "UPDATE `accountTBL` 
            SET `password` = '$newPassword' 
            WHERE `accountTBL`.`userID` = '$userID';";

            $changePass = $conn->prepare($changeQuery);
            $changePass->execute();

            echo "password has been changed";
        }else{
            echo "old password is incorrect";
        }
    }
    //change username
    if($_POST['requestType'] === "changeUsername"){
        $oldUsername = base64_encode($_POST["oldUsername"]);
        $newUsername = base64_encode($_POST["newUsername"]);

        $userID = $_SESSION["userID"];

        $verifyQuery = "SELECT `accountTBL`.*
            FROM `accountTBL`
            WHERE `accountTBL`.`username` LIKE '$oldUsername'
            AND `accountTBL`.`userID` LIKE '$userID'";

        $check = $conn->prepare($verifyQuery);
        $check->execute();
        $result = $check->get_result();
        if ($result->num_rows == 1) {
            $changeQuery = "UPDATE `accountTBL` 
            SET `username` = '$newUsername' 
            WHERE `accountTBL`.`userID` = '$userID';";

            $changePass = $conn->prepare($changeQuery);
            $changePass->execute();

            echo "username has been changed";
        }else{
            echo "old username is incorrect";
        }
    }
}

?>