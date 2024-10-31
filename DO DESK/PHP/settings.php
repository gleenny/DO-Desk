<?php 

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //change password
    if($_POST['requestType'] === "changePassword"){
        $oldPassword = base64_encode($_POST["oldPassword"]);
        $newPassword = base64_encode($_POST["newPassword"]);

        $userID = $_SESSION["userID"];

        $verifyQuery = "SELECT `accounttbl`.*
            FROM `accounttbl`
            WHERE `accounttbl`.`password` LIKE '$oldPassword'
            AND `accounttbl`.`userID` LIKE '$userID'";

        $check = $conn->prepare($verifyQuery);
        $check->execute();
        $result = $check->get_result();
        if ($result->num_rows == 1) {
            $changeQuery = "UPDATE `accounttbl` 
            SET `password` = '$newPassword' 
            WHERE `accounttbl`.`userID` = '$userID';";

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

        $verifyQuery = "SELECT `accounttbl`.*
            FROM `accounttbl`
            WHERE `accounttbl`.`username` LIKE '$oldUsername'
            AND `accounttbl`.`userID` LIKE '$userID'";

        $check = $conn->prepare($verifyQuery);
        $check->execute();
        $result = $check->get_result();
        if ($result->num_rows == 1) {
            $changeQuery = "UPDATE `accounttbl` 
            SET `username` = '$newUsername' 
            WHERE `accounttbl`.`userID` = '$userID';";

            $changePass = $conn->prepare($changeQuery);
            $changePass->execute();

            echo "username has been changed";
        }else{
            echo "old username is incorrect";
        }
    }
}

?>