<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST["requestType"] == "SearchStudentViolation"){
        // Retrieve form data
        //$studentNumber = isset($_POST['studentNumber']) ? $_POST['studentNumber'] : '';
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
        //$status = $_POST['status'];

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
                LEFT JOIN `usertbl` ON `violationtbl`.`recordedBy` = `usertbl`.`personID`";

        if (!empty($studentNumber)) {
            $sql .= "WHERE `studenttbl`.`studentNumber` LIKE '$studentNumber'";
        }

        else if (!empty($studentName)) {
            $sql .= " WHERE CONCAT(`studenttbl`.`firstName`, COALESCE(`studenttbl`.`middleName`, ''), `studenttbl`.`lastName`) LIKE '%$studentName%'"; 
        }

        if (!empty($searchCourse) ) {
            $sql .= " AND course LIKE '%$searchCourse%'";
        }
        else if (!empty($searchSection)) {
            $sql .= " AND section LIKE '%$searchSection%'";
        }
        else if (!empty($typeOfViolation)) {
            $sql .= " AND ViolationType LIKE '%$typeOfViolation%'";
        }
        else if (!empty($searchCase)) {
            $sql .= " AND ViolationCase LIKE '%$searchCase%'";
        }

        //$sql .= ";";

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
            }
        }

        echo json_encode($searchResults);

        $conn->close();
        }
    }
?>