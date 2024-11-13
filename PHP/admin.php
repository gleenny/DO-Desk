<?php

session_start(); // Start the session
require_once 'connections.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //searching audit
    if($_POST["requestType"] === "searchAudit"){
        $conditionCounter = 0;
        $logID = $_POST["logID"];
        $name = str_ireplace(' ', '%', $_POST['name']);
        $date = $_POST["date"];
        $process = $_POST['process'];
        $note = $_POST["note"];
        if(!($logID == "")){
            $conditionCounter++;
        }
        if(!($name == "")){
            $conditionCounter++;
        }
        if(!($date == "")){
            $conditionCounter++;
        }
        if(!($process == "")){
            $conditionCounter++;
        }
        if(!($note == "")){
            $conditionCounter++;
        }
        $query = "SELECT `audittbl`.*,
         `accounttbl`.`userID`,
          `accounttbl`.`personID`,
           `usertbl`.`firstName`,
            `usertbl`.`middleName`,
             `usertbl`.`lastName`
        FROM `audittbl` 
        LEFT JOIN `accounttbl` ON `audittbl`.`userID` = `accounttbl`.`userID` 
        LEFT JOIN `usertbl` ON `accounttbl`.`personID` = `usertbl`.`personID` 
        WHERE ";
        for($i = 0; $i < $conditionCounter; $i++){
            if($i >= 1){
                $query .= " AND ";
            }

            if(!($logID == "")){
                $query .= "`auditTBL`.`logID` LIKE '%$logID%'";
                $logID = "";
            }
            else if(!($name == "")){
                $query .= "CONCAT(`userTBL`.`firstName`, COALESCE(`userTBL`.`middleName`, ''), `userTBL`.`lastName`) LIKE '%$name%'";
                $name = "";
            }
            else if(!($date == "")){
                $query .= "`auditTBL`.`transactionDateTime` LIKE '%$date%'";
                $date = "";
            }
            else if(!($process == "")){
                $query .= "`auditTBL`.`process` LIKE '%$process%'";
                $process = "";
            }
            else if(!($note == "")){
                $query .= "`auditTBL`.`note` LIKE '%$note%'";
                $note = "";
            }
        }
        $result = $conn->query($query);
        $searchResults = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults["logID"][] = $row['logID'];
                $searchResults["firstName"][] = $row['firstName'];
                $searchResults["middleName"][] = $row['middleName'];
                $searchResults["lastName"][] = $row['lastName'];
                $searchResults["dateTime"][] = $row['transactionDateTime'];
                $searchResults["process"][] = $row['process'];
                $searchResults["note"][] = $row['note'];
            }
        }
        echo json_encode($searchResults);
        $conn->close();
    }
    //searching user
    if($_POST["requestType"] === "searchUser"){
        $conditionCounter = 0;

        $userID = $_POST["userID"];
        $name = str_ireplace(' ', '%', $_POST['name']);
        $active = $_POST["status"];

        if(!($userID == "")){
            $conditionCounter++;
        }
        if(!($name == "")){
            $conditionCounter++;
        }
        if(!($active == "")){
            $conditionCounter++;
        }

        $query = "SELECT `userTBL`.`firstName`,
        `userTBL`.`middleName`,
         `userTBL`.`lastName`,
          `accountTBL`.`userID`,
           `accountTBL`.`username`,
            `userTBL`.`role`,
             `accountTBL`.`active`
        FROM `userTBL` 
        LEFT JOIN `accountTBL` ON `accountTBL`.`personID` = `userTBL`.`personID`
        WHERE ";

        for($i = 0; $i < $conditionCounter; $i++){
            if($i >= 1){
                $query .= " AND ";
            }

            if(!($userID == "")){
                $query .= "`accountTBL`.`userID` LIKE '%$userID%'";
                $userID = "";
            }
            else if(!($name == "")){
                $query .= "CONCAT(`userTBL`.`firstName`, COALESCE(`userTBL`.`middleName`, ''), `userTBL`.`lastName`) LIKE '%$name%'";
                $name = "";
            }
            else if(!($active == "")){
                $query .= "`accountTBL`.`active` LIKE '%$active%'";
                $active = "";
            }
        }
        $result = $conn->query($query);
        $searchResults = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults["firstName"][] = $row['firstName'];
                $searchResults["middleName"][] = $row['middleName'];
                $searchResults["lastName"][] = $row['lastName'];
                $searchResults["userID"][] = $row['userID'];
                $searchResults["username"][] = base64_decode($row['username']);
                $searchResults["role"][] = $row['role'];
                $searchResults["active"][] = $row['active'];
            }
        }
        echo json_encode($searchResults);

        $conn->close();
    }
    //adding user
    if($_POST["requestType"] === "addUser"){
        $firstName = $_POST["firstName"];
        $middleName = $_POST["middleName"];
        $lastName = $_POST["lastName"];
        $username = base64_encode($_POST["username"]);
        $password = base64_encode($_POST["password"]);
        $role = $_POST["role"];

        //add to user table
        $userQuery = "INSERT INTO `userTBL` (`personID`, `firstName`, `lastName`, `middleName`, `role`) 
        VALUES (NULL, '$firstName', '$lastName', '$middleName', '$role');";
        $addUser = $conn->prepare($userQuery);
        $addUser->execute();

        //getting personID
        $getPersonIDQuery = "SELECT `userTBL`.`personID`,
                            `userTBL`.`firstName`,
                             `userTBL`.`middleName`,
                              `userTBL`.`lastName`,
                               `userTBL`.`role`
                            FROM `userTBL`;";
        $result = $conn->query($getPersonIDQuery);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $personID = $row['personID'];
            }
        }

        //adding to account table
        $accountQuery = "INSERT INTO `accountTBL` (`userID`, `username`, `password`, `personID`, `active`) 
        VALUES (NULL, '$username', '$password', '$personID', '1');";
        $addAccount = $conn->prepare($accountQuery);
        $addAccount->execute();

        //audit
        $dateTime = date("Y-m-d H:i:s");
        $userID = $_SESSION['userID'];
        $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
        VALUES (NULL, '$userID', '$dateTime', 'Added new user', '$personID : $firstName $lastName');";
        $audit = $conn->prepare($auditQuery);
        $audit->execute();

        echo "User has been added";

        $conn->close();
    }
    //updating status
    if($_POST["requestType"] === "updateStatus"){
        $adminID = $_POST["adminID"];
        $adminStatus = $_POST["adminStatus"];

        $query = "UPDATE `accountTBL`
        SET `active` = '$adminStatus'
        WHERE `userID` = '$adminID'";
        $updateAccount = $conn->prepare($query);
        $updateAccount->execute();

        $dateTime = date("Y-m-d H:i:s");
        $userID = $_SESSION['userID'];
        $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
        VALUES (NULL, '$userID', '$dateTime', 'Updated the status of user', '$adminID : $adminStatus');";
        $audit = $conn->prepare($auditQuery);
        $audit->execute();

        echo "User has been updated";
    }
    //changing password
    if($_POST["requestType"] === "changePassword"){
        $userID = $_POST["userID"];
        $password = base64_encode($_POST["password"]);

        $query = "UPDATE `accountTBL` 
        SET `password` = '$password' 
        WHERE `accountTBL`.`userID` = '$userID'; ";

        $changePassword = $conn->prepare($query);
        $changePassword->execute();

        $dateTime = date("Y-m-d H:i:s");
        $userID = $_SESSION['userID'];
        $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
        VALUES (NULL, '$userID', '$dateTime', 'Changed password of user', '$userID');";
        $audit = $conn->prepare($auditQuery);
        $audit->execute();

        echo "password has been changed";
    }
    //changing username
    if($_POST["requestType"] === "changeUsername"){
        $userID = $_POST["userID"];
        $username = base64_encode($_POST["username"]);

        $query = "UPDATE `accountTBL` 
        SET `username` = '$username' 
        WHERE `accountTBL`.`userID` = '$userID'; ";

        $changeUsername = $conn->prepare($query);
        $changeUsername->execute();

        $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'Changed username of user', '$userID');";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();

        echo "Username has been changed";
    }
    if($_POST["requestType"] == "getAdminID"){
        $query = "SELECT `accountTBL`.`userID` FROM `accountTBL`;";
   
       $result = $conn->query($query);
   
       if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()){
               $userID["userID"][] = $row['userID'];
           }
           echo json_encode($userID);
       }     
       $conn->close();
    }
}
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT `userTBL`.`firstName`,
    `userTBL`.`middleName`,
     `userTBL`.`lastName`,
      `accountTBL`.`userID`,
       `accountTBL`.`username`,
        `accountTBL`.`password`,
         `userTBL`.`role`,
          `accountTBL`.`active`
    FROM `userTBL` 
    LEFT JOIN `accountTBL` ON `accountTBL`.`personID` = `userTBL`.`personID`;";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $user["firstName"][] = $row['firstName'];
            $user["middleName"][] = $row['middleName'];
            $user["lastName"][] = $row['lastName'];
            $user["userID"][] = $row['userID'];
            $user["username"][] = base64_decode($row['username']);
            $user["password"][] = base64_decode($row['password']);
            $user["role"][] = $row['role'];
            $user["active"][] = $row['active'];
        }
        print_r (json_encode($user));
    }     
    $conn->close();
}

?>