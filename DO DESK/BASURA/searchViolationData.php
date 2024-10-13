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
        if($_POST['violationType'] == "None"){
            $typeOfViolation = "";
        }else {
            $typeOfViolation = $_POST['violationType'];
        }
        $searchCase = $_POST['violationCase'];
        if($_POST['status'] == "None"){
            $status = "";
        }else if($_POST['status'] == "Resolve"){
            $status = 0;
        }else if($_POST['status'] == "Unresolved"){
            $status = 1;
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
    }
?>