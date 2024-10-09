<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    
    // Retrieve form data
    $studentNumber = isset($_POST['studentNumber']) ? $_POST['studentNumber'] : '';
    $studentName = isset($_POST['studentName']) ? $_POST['studentName'] : '';
    $searchCourse = isset($_POST['course']) ? $_POST['course'] : '';
    $searchSection = isset($_POST['section']) ? $_POST['section'] : '';
    $typeOfViolation = isset($_POST['violationType']) ? $_POST['violationType'] : '';
    $searchCase = isset($_POST['violationCase']) ? $_POST['violationCase'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    // SQL query
 

    if (!empty($studentNumber)) {
        $sql .= "SELECT `violationtbl`.*,
            `studenttbl`.`firstName`,
            `studenttbl`.`middleName`,
            `studenttbl`.`lastName`,
            `studenttbl`.`course`,
            `studenttbl`.`section`,
            
            `usertbl`.`lastName` AS `Officer`

            FROM `violationtbl` 
            LEFT JOIN `studenttbl` ON `violationtbl`.`%$studentNumber%` = `studenttbl`.`studentNumber` 
            LEFT JOIN `usertbl` ON `violationtbl`.`recordedBy` = `usertbl`.`personID`;"; 
    }

    else if (!empty($studentName)) {
        $sql .= "SELECT `violationtbl`.*,
        `studenttbl`.'%$studentName%',
        `studenttbl`.`middleName`,
        `studenttbl`.`lastName`,
        `studenttbl`.`course`,
        `studenttbl`.`section`,
        
        `usertbl`.`lastName` AS `Officer`

        FROM `violationtbl` 
        LEFT JOIN `studenttbl` ON `violationtbl`.`studentNumber` = `studenttbl`.`studentNumber` 
        LEFT JOIN `usertbl` ON `violationtbl`.`recordedBy` = `usertbl`.`personID`;"; 
    }

    else if (!empty($searchCourse)) {
        $sql .= " AND course LIKE '%$searchCourse%'";
    }

    else if (!empty($searchSection)) {
        $sql .= " AND section LIKE '%$searchSection%'";
    }

    else if (!empty($typeOfViolation)) {
        $sql .= " AND ViolationType = '$typeOfViolation'";
    }

    else if (!empty($searchCase)) {
        $sql .= " AND ViolationCase LIKE '%$searchCase%'";
    }

    else if (!empty($status)) {
        $sql .= " AND status = '$status'";
    }
    else {
        echo "Error: Invalid";
    }

    $result = $conn->query($sql);
    $searchResults = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
    }
    
    print_r(json_encode($searchResults));
    
    $conn->close();
}

?>