<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST["requestType"] == "SearchStudentViolation"){
        //$studentNumber = isset($_POST['studentNumber']) ? $_POST['studentNumber'] : '';\

        $conditionCounter = 0;

        $studentNumber = $_POST['studentNumber'];
        $studentName = $_POST['studentName'];
        $searchCourse = $_POST['course'];
        $searchSection = $_POST['section'];
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
        if(!($searchSection == "")){
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
        $sql = "SELECT `violationtbl`.*,
                `studenttbl`.`firstName`,
                `studenttbl`.`middleName`,
                `studenttbl`.`lastName`,
                `studenttbl`.`course`,
                `studenttbl`.`section`,
                
                `usertbl`.`lastName` AS `Officer`

                FROM `violationtbl` 
                LEFT JOIN `studenttbl` ON `violationtbl`.`studentNumber` = `studenttbl`.`studentNumber` 
                LEFT JOIN `usertbl` ON `violationtbl`.`recordedBy` = `usertbl`.`personID`
                WHERE ";

        for($i = 0; $i < $conditionCounter; $i++){
            if($i >= 1){
                $sql .= " AND ";
            }

            if(!($studentNumber == "")){
                $sql .= "`studenttbl`.`studentNumber` LIKE '%$studentNumber%'";
                $studentNumber = "";
            }
            else if(!($studentName == "")){
                $sql .= "CONCAT(`studenttbl`.`firstName`, COALESCE(`studenttbl`.`middleName`, ''), `studenttbl`.`lastName`) LIKE '%$studentName%'";
                $studentName = "";
            }
            else if(!($searchCourse == "")){
                $sql .= "`studenttbl`.`course` LIKE '%$searchCourse%'";
                $searchCourse = "";
            }
            else if(!($searchSection == "")){
                $sql .= "`studenttbl`.`section` LIKE '%$searchSection%'";
                $searchSection = "";
            }
            else if(!($typeOfViolation == "")){
                $sql .= "`violationtbl`.`violationType` LIKE '%$typeOfViolation%'";
                $typeOfViolation = "";
            }
            else if(!($searchCase == "")){
                $sql .= "`violationtbl`.`violationCase` LIKE '%$searchCase%'";
                $searchCase = "";
            }
            else if(!($status == "")){
                $sql .= "`violationtbl`.`active` LIKE '%$status%'";
                $status = "";
            }
            else if(!($searchDate == "")){
                $sql .= "`violationtbl`.`violationDate` = '$searchDate'";
                $searchDate = "";
            }
        }
        $sql .= "ORDER BY `violationtbl`.`violationDate` DESC";

        $result = $conn->query($sql);
        $searchResults = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults["violationID"][] = $row['violationID'];
                $searchResults["violationType"][] = $row['violationType'];
                $searchResults["violationCase"][] = $row['violationCase'];
                $searchResults["studentNumber"][] = $row['studentNumber'];
                $searchResults["active"][] = $row['active'];
                $searchResults["recordedBy"][] = $row['recordedBy'];
                $searchResults["firstName"][] = $row['firstName'];
                $searchResults["middleName"][] = $row['middleName'];
                $searchResults["lastName"][] = $row['lastName'];
                $searchResults["course"][] = $row['course'];
                $searchResults["section"][] = $row['section'];
                $searchResults["Officer"][] = $row['Officer'];
                $searchResults["violationDate"][] = $row['violationDate'];
            }
        }
        //echo $sql;
        //print_r($searchResults);
        echo json_encode($searchResults);

        $conn->close();
    }
    if($_POST['requestType'] == "addViolation"){
        $violationType = $_POST["violationType"];
        $violationCase = $_POST["violationCase"];
        $studentNumber = $_POST["studentNumber"];
        $currentDate = date("Y-m-d");
        
        $query = "INSERT INTO `violationtbl` (`violationID`, `violationType`, `violationCase`, `studentNumber`, `active`, `recordedBy`, `violationDate`) 
        VALUES (NULL, '$violationType', '$violationCase', '$studentNumber', '1', '1000101', '$currentDate');";
    
        if ($conn->query($query) === TRUE) {
            echo "New record created successfully!";
      
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    if($_POST['requestType'] == "updateStatus"){
        
        $violationID = $_POST["violationID"];
        if($_POST["violationStatus"] == "Resolve"){
            $violationStatus = '0';
        }
        else if($_POST["violationStatus"] == "Unresolve"){
            $violationStatus = '1';
        }

        $query = "UPDATE `violationtbl`
                SET `active` = '$violationStatus'
                WHERE `violationID` = '$violationID'";

        if ($conn->query($query) === TRUE) {
            echo "Data has been updated!";

        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
        $conn->close();
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $cases = [];
    $minorCount = 0;
    $majorCount = 0;

    $query = "SELECT `violationtbl`.*,
        `usertbl`.`firstName` AS `doFirst`,
        `usertbl`.`lastName` AS `doLast`,
        `studenttbl`.`firstName`,
        `studenttbl`.`middleName`,
        `studenttbl`.`lastName`,
        `studenttbl`.`course`,
        `studenttbl`.`section`,
        
        `usertbl`.`lastName` AS `Officer`

    FROM `violationtbl` 
    LEFT JOIN `studenttbl` ON `violationtbl`.`studentNumber` = `studenttbl`.`studentNumber` 
    LEFT JOIN `usertbl` ON `violationtbl`.`recordedBy` = `usertbl`.`personID`
    ORDER BY `violationtbl`.`violationDate` DESC";

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
            $cases["section"][] = $row['section'];
            $cases["Officer"][] = $row['Officer'];
            $cases["violationDate"][] = $row['violationDate'];
        }
        $cases["minorCount"][] = $minorCount;
        $cases["majorCount"][] = $majorCount;
        print_r (json_encode($cases));
        //print_r ($cases);
    }
        
    $conn->close();
}

?>