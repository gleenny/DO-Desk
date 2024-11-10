<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //search violations
    if($_POST["requestType"] == "SearchStudentViolation"){
        $conditionCounter = 0;

        $studentNumber = $_POST['studentNumber'];
        $studentName = str_ireplace(' ', '%', $_POST['studentName']);
        $searchCourse = $_POST['course'];
        $typeOfViolation = $_POST['violationType'];
        $searchCase = $_POST['violationCase'];
        $status = $_POST['status'];
        $searchDate = $_POST['date'];

        if(!($studentNumber == "")){
            $conditionCounter++;
        }
        if(!($studentName == "")){
            $conditionCounter++;
        }
        if(!($searchCourse == "")){
            $conditionCounter++;
        }
        if(!($typeOfViolation == "")){
            $conditionCounter++;
        }
        if(!($searchCase == "")){
            $conditionCounter++;
        }
        if(!($status == "")){
            $conditionCounter++;
        }
        if(!($searchDate == "")){
            $conditionCounter++;
        }
        // SQL query
        $sql = "SELECT `violationTBL`.*,
                `accountTBL`.`personID`,
                `userTBL`.`firstName` AS `doFirst`,
                `userTBL`.`lastName` AS `doLast`,
                `studentTBL`.`firstName`,
                    `studentTBL`.`middleName`,
                    `studentTBL`.`lastName`,
                    `studentTBL`.`course`,
                    `offenseTBL`.`offense` AS `violationCase`,
                        `offenseTBL`.`violationType`
                FROM `violationTBL` 
                LEFT JOIN `accountTBL` ON `violationTBL`.`recordedBy` = `accountTBL`.`userID` 
                LEFT JOIN `userTBL` ON `accountTBL`.`personID` = `userTBL`.`personID` 
                LEFT JOIN `studentTBL` ON `violationTBL`.`studentNumber` = `studentTBL`.`studentNumber` 
                LEFT JOIN `offenseTBL` ON `violationTBL`.`offenseID` = `offenseTBL`.`offenseID` 
                WHERE ";

        for($i = 0; $i < $conditionCounter; $i++){
            if($i >= 1){
                $sql .= " AND ";
            }

            if(!($studentNumber == "")){
                $sql .= "`violationTBL`.`studentNumber` LIKE '%$studentNumber%'";
                $studentNumber = "";
            }
            else if(!($studentName == "")){
                $sql .= "CONCAT(`studentTBL`.`firstName`, COALESCE(`studentTBL`.`middleName`, ''), `studentTBL`.`lastName`) LIKE '%$studentName%'";
                $studentName = "";
            }
            else if(!($searchCourse == "")){
                $sql .= "`studentTBL`.`course` LIKE '%$searchCourse%'";
                $searchCourse = "";
            }
            else if(!($typeOfViolation == "")){
                $sql .= "`offenseTBL`.`violationType` LIKE '%$typeOfViolation%'";
                $typeOfViolation = "";
            }
            else if(!($searchCase == "")){
                $sql .= "`offenseTBL`.`offense` LIKE '%$searchCase%'";
                $searchCase = "";
            }
            else if(!($status == "")){
                $sql .= "`violationTBL`.`active` LIKE '%$status%'";
                $status = "";
            }
            else if(!($searchDate == "")){
                $sql .= "`violationTBL`.`violationDate` = '$searchDate'";
                $searchDate = "";
            }
        }
        $sql .= " ORDER BY `violationTBL`.`violationDate` DESC;";

        $result = $conn->query($sql);
        $searchResults = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults["violationID"][] = $row['violationID'];
                $searchResults["violationType"][] = $row['violationType'];
                $searchResults["violationCase"][] = $row['violationCase'];
                $searchResults["studentNumber"][] = $row['studentNumber'];
                $searchResults["active"][] = $row['active'];
                $searchResults["doFirst"][] = $row['doFirst'];
                $searchResults["doLast"][] = $row['doLast'];
                $searchResults["recordedBy"][] = $row['recordedBy'];
                $searchResults["firstName"][] = $row['firstName'];
                $searchResults["middleName"][] = $row['middleName'];
                $searchResults["lastName"][] = $row['lastName'];
                $searchResults["course"][] = $row['course'];
                $searchResults["violationDate"][] = $row['violationDate'];
                //not in use
                $searchResults["offenseID"][] = $row['offenseID'];
                $searchResults["personID"][] = $row['personID'];
            }
        }
        echo json_encode($searchResults);

        $conn->close();
    }
    //adding violations
    if($_POST['requestType'] == "addViolation"){
        $violationCase = $_POST["violationCase"];
        $studentNumber = $_POST["studentNumber"];
        $doID = $_SESSION["userID"];
        $currentDate = date("Y-m-d");
        
        $offenseIDQuery = "SELECT `offenseTBL`.*
                        FROM `offenseTBL`
                        WHERE `offenseTBL`.`offense` LIKE '$violationCase';";
        
        $result = $conn->query($offenseIDQuery);

        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $offenseID = $row['offenseID'];
                $violationType["type"][] = $row['violationType'];
            }
        }

        $query = "INSERT INTO `violationTBL` (`violationID`, `offenseID`, `studentNumber`, `active`, `recordedBy`, `violationDate`) 
        VALUES (NULL, '$offenseID', '$studentNumber', '1', '$doID', '$currentDate');";
    
        if ($conn->query($query) === TRUE) {
            $violationType["result"][] = "Data has been added";

            $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'Added new violation', 'Student Number: $studentNumber - Violation Case: $offenseID');";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();
            
            echo json_encode($violationType);
        } else {
            $violationType["result"][] = "Error: " . $query . "<br>" . $conn->error;
            echo json_encode($violationType);
        }
    
        $conn->close();
    }
    //updating violation status
    if($_POST['requestType'] == "updateStatus"){
        
        $violationID = $_POST["violationID"];
        if($_POST["violationStatus"] == "Resolve"){
            $violationStatus = '0';
        }
        else if($_POST["violationStatus"] == "Unresolve"){
            $violationStatus = '1';
        }

        $query = "UPDATE `violationTBL`
                SET `active` = '$violationStatus'
                WHERE `violationID` = '$violationID'";

        if ($conn->query($query) === TRUE) {
            echo "Data has been updated!";

            $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $statusChange = $_POST["violationStatus"];
            $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'Changed violation status', 'Violation ID: $violationID - changed into $statusChange');";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();

        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
        $conn->close();
    }
    //checking minor violations
    if($_POST['requestType'] == "checkMinorViolationCount"){
        
        $studentNumber = $_POST["studentNumber"];

        $query = "SELECT `violationTBL`.`violationID`,
         `violationTBL`.`offenseID`,
          `offenseTBL`.`offense` AS `violationCase`,
           `offenseTBL`.`violationType`,
            `violationTBL`.`active`,
             `violationTBL`.`violationDate`,
              `studentTBL`.`firstName`,
              `violationTBL`.`studentNumber`
            FROM `violationTBL` 
            LEFT JOIN `offenseTBL` ON `violationTBL`.`offenseID` = `offenseTBL`.`offenseID` 
            LEFT JOIN `studentTBL` ON `violationTBL`.`studentNumber` = `studentTBL`.`studentNumber`
            WHERE `violationTBL`.`studentNumber` LIKE '$studentNumber' AND `offenseTBL`.`violationType` LIKE 'Minor'
            ORDER BY `violationTBL`.`violationID` DESC;";

        $results = $conn->query($query);
        $minorViolationResults = [];

        if($results->num_rows > 0){  
            while ($row = $results->fetch_assoc()) {
                $minorViolationResults["firstName"][] = $row['firstName'];
                $minorViolationResults["studentNumber"][] = $row['studentNumber'];
                $minorViolationResults["violationID"][] = $row['violationID'];
                $minorViolationResults["violationType"][] = $row['violationType'];
                $minorViolationResults["violationCase"][] = $row['violationCase'];
                $minorViolationResults["active"][] = $row['active'];
                $minorViolationResults["violationDate"][] = $row['violationDate'];
            }
        }
        echo json_encode($minorViolationResults);
        $conn->close();
    }
    if($_POST['requestType'] == "getViolationID"){

        $query = "SELECT `violationTBL`.`violationID` FROM `violationTBL`;";

        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $vID["violationID"][] = $row['violationID'];
            }
            echo json_encode($vID);
        }     
        $conn->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $cases = [];
    $minorCount = 0;
    $majorCount = 0;

    $query = "SELECT `violationTBL`.*,
     `accountTBL`.`personID`,
      `userTBL`.`firstName` AS `doFirst`,
       `userTBL`.`lastName` AS `doLast`,
        `studentTBL`.`firstName`,
         `studentTBL`.`middleName`,
          `studentTBL`.`lastName`,
           `studentTBL`.`course`,
            `offenseTBL`.`offense` AS `violationCase`,
             `offenseTBL`.`violationType`
    FROM `violationTBL` 
	LEFT JOIN `accountTBL` ON `violationTBL`.`recordedBy` = `accountTBL`.`userID` 
	LEFT JOIN `userTBL` ON `accountTBL`.`personID` = `userTBL`.`personID` 
	LEFT JOIN `studentTBL` ON `violationTBL`.`studentNumber` = `studentTBL`.`studentNumber` 
	LEFT JOIN `offenseTBL` ON `violationTBL`.`offenseID` = `offenseTBL`.`offenseID` 
    ORDER BY `violationTBL`.`violationID` DESC";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            if($row['violationType'] == "Minor" && $row['active'] =='1'){
                $minorCount++;
            }else if($row['violationType'] == "Major" && $row['active'] =='1'){
                $majorCount++;
            }
            $cases["violationID"][] = $row['violationID'];
            $cases["violationType"][] = $row['violationType'];
            $cases["violationCase"][] = $row['violationCase'];
            $cases["studentNumber"][] = $row['studentNumber'];
            $cases["active"][] = $row['active'];
            $cases["doFirst"][] = $row['doFirst'];
            $cases["doLast"][] = $row['doLast'];
            $cases["recordedBy"][] = $row['recordedBy'];
            $cases["firstName"][] = $row['firstName'];
            $cases["middleName"][] = $row['middleName'];
            $cases["lastName"][] = $row['lastName'];
            $cases["course"][] = $row['course'];
            $cases["violationDate"][] = $row['violationDate'];
            //not in use
            $cases["offenseID"][] = $row['offenseID'];
            $cases["personID"][] = $row['personID'];
        }
        $cases["minorCount"][] = $minorCount;
        $cases["majorCount"][] = $majorCount;
        print_r (json_encode($cases));
    }     
    $conn->close();
}

?>