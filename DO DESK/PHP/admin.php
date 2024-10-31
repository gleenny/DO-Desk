<?php

session_start(); // Start the session
require_once 'connections.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //searching user
    if($_POST["requestType"] === "searchUser"){
        $conditionCounter = 0;

        $userID = $_POST["userID"];
        $name = $_POST["name"];
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
            `accountTBL`.`password`,
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
                $searchResults["password"][] = base64_decode($row['password']);
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
        $personID;
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

        echo "User has been updated";
    }
    //changing password
    if($_POST["requestType"] === "changePassword"){
        $userID = $_POST["userID"];
        $password = base64_encode($_POST["password"]);

        $query = "UPDATE `accounttbl` 
        SET `password` = '$password' 
        WHERE `accounttbl`.`userID` = '$userID'; ";

        $changePassword = $conn->prepare($query);
        $changePassword->execute();

        echo "password has been changed";
    }
    //changing username
    if($_POST["requestType"] === "changeUsername"){
        $userID = $_POST["userID"];
        $username = base64_encode($_POST["username"]);

        $query = "UPDATE `accounttbl` 
        SET `username` = '$username' 
        WHERE `accounttbl`.`userID` = '$userID'; ";

        $changeUsername = $conn->prepare($query);
        $changeUsername->execute();

        echo "Username has been changed";
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