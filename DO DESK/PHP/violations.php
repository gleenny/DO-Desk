<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //search violations
    if($_POST["requestType"] == "SearchStudentViolation"){
        $conditionCounter = 0;

        $studentNumber = $_POST['studentNumber'];
        $studentName = $_POST['studentName'];
        $searchCourse = $_POST['course'];
        $typeOfViolation = $_POST['violationType'];
        $searchCase = $_POST['violationCase'];
        if($_POST['status'] == "Resolve"){
            $status = 0;
        }else if($_POST['status'] == "Unresolved"){
            $status = 1;
        }else{
            $status = $_POST['status'];
        }
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
                `userTBL`.`firstName` AS `doFirst`,
                `userTBL`.`lastName` AS `doLast`,
                `studentTBL`.`firstName`,
                `studentTBL`.`middleName`,
                `studentTBL`.`lastName`,
                `studentTBL`.`course`,
                
                `userTBL`.`lastName` AS `Officer`

                FROM `violationTBL` 
                LEFT JOIN `studentTBL` ON `violationTBL`.`studentNumber` = `studentTBL`.`studentNumber` 
                LEFT JOIN `userTBL` ON `violationTBL`.`recordedBy` = `userTBL`.`personID`
                WHERE ";

        for($i = 0; $i < $conditionCounter; $i++){
            if($i >= 1){
                $sql .= " AND ";
            }

            if(!($studentNumber == "")){
                $sql .= "`studentTBL`.`studentNumber` LIKE '%$studentNumber%'";
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
                $sql .= "`violationTBL`.`violationType` LIKE '%$typeOfViolation%'";
                $typeOfViolation = "";
            }
            else if(!($searchCase == "")){
                $sql .= "`violationTBL`.`violationCase` LIKE '%$searchCase%'";
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
        $sql .= "ORDER BY `violationTBL`.`violationDate` DESC";

        $result = $conn->query($sql);
        $searchResults = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults["violationID"][] = $row['violationID'];
                $searchResults["violationType"][] = $row['violationType'];
                $searchResults["violationCase"][] = $row['violationCase'];
                $searchResults["studentNumber"][] = $row['studentNumber'];
                $searchResults["doFirst"][] = $row['doFirst'];
                $searchResults["doLast"][] = $row['doLast'];
                $searchResults["active"][] = $row['active'];
                $searchResults["recordedBy"][] = $row['recordedBy'];
                $searchResults["firstName"][] = $row['firstName'];
                $searchResults["middleName"][] = $row['middleName'];
                $searchResults["lastName"][] = $row['lastName'];
                $searchResults["course"][] = $row['course'];
                $searchResults["Officer"][] = $row['Officer'];
                $searchResults["violationDate"][] = $row['violationDate'];
            }
        }
        echo json_encode($searchResults);

        $conn->close();
    }
    //adding violations
    if($_POST['requestType'] == "addViolation"){
        $violationType = $_POST["violationType"];
        $violationCase = $_POST["violationCase"];
        $studentNumber = $_POST["studentNumber"];
        $doID = $_SESSION["userID"];
        $currentDate = date("Y-m-d");
        
        $query = "INSERT INTO `violationTBL` (`violationID`, `violationType`, `violationCase`, `studentNumber`, `active`, `recordedBy`, `violationDate`) 
        VALUES (NULL, '$violationType', '$violationCase', '$studentNumber', '1', '$doID', '$currentDate');";
    
        if ($conn->query($query) === TRUE) {
            echo "New record created successfully!";

            $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'Added new violation', 'Student Number: $studentNumber - Violation Case: $violationCase');";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();
      
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
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

        $query = "SELECT `studentTBL`.`firstName`, `violationTBL`.`violationID`, `violationTBL`.`violationType`, `violationTBL`.`violationCase`, `violationTBL`.`active`, `violationTBL`.`violationDate`, `violationTBL`.`studentNumber`
                    FROM `studentTBL` 
	                LEFT JOIN `violationTBL` ON `violationTBL`.`studentNumber` = `studentTBL`.`studentNumber`
                    WHERE `violationTBL`.`studentNumber` LIKE '$studentNumber' AND `violationTBL`.`violationType` LIKE 'Minor'
                    ORDER BY `violationTBL`.`violationID` DESC";

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
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $cases = [];
    $minorCount = 0;
    $majorCount = 0;

    $query = "SELECT `violationTBL`.*,
        `userTBL`.`firstName` AS `doFirst`,
        `userTBL`.`lastName` AS `doLast`,
        `studentTBL`.`firstName`,
        `studentTBL`.`middleName`,
        `studentTBL`.`lastName`,
        `studentTBL`.`course`,
        
        `userTBL`.`lastName` AS `Officer`

    FROM `violationTBL` 
    LEFT JOIN `studentTBL` ON `violationTBL`.`studentNumber` = `studentTBL`.`studentNumber` 
    LEFT JOIN `userTBL` ON `violationTBL`.`recordedBy` = `userTBL`.`personID`
    ORDER BY `violationTBL`.`violationDate` DESC";

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
            $cases["Officer"][] = $row['Officer'];
            $cases["violationDate"][] = $row['violationDate'];
        }
        $cases["minorCount"][] = $minorCount;
        $cases["majorCount"][] = $majorCount;
        print_r (json_encode($cases));
    }     
    $conn->close();
}

?>