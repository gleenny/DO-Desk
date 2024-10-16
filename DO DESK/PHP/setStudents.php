<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //adding students
    if($_POST["requestType"] == "Students"){
        $studentNumber = $_POST["studentNumber"];
        $studentFirstName = $_POST["firstName"];
        $studentMiddleName = $_POST["middleName"];
        $studentLastName = $_POST["lastName"];
        $course = $_POST["course"];
        $section = $_POST["section"];

        $studentQuery = "INSERT INTO `studentTBL` (`studentNumber`, `firstName`, `middleName`, `lastName`, `course`, `section`, `active`) 
        VALUES ('$studentNumber', '$studentFirstName', '$studentMiddleName', '$studentLastName', '$course', '$section', '1');";

        if ($conn->query($studentQuery) === TRUE) {
            $result = "New record created successfully!";

        } else {
            $result = "Error: " . $studentQuery . "<br>" . $conn->error;
        }

        print_r($result);
    }
    //adding parents
    if($_POST["requestType"] == "Parents"){
        $parentFirstName = $_POST["firstName"];
        $parentMiddleName = $_POST["middleName"];
        $parentLastName = $_POST["lastName"];
        $mobileNumber = $_POST["mobileNumber"];

        $parentQuery = "INSERT INTO `parentTBL` (`parentID`, `firstName`, `middleName`, `lastName`, `mobileNumber`) 
        VALUES (NULL, '$parentFirstName', '$parentMiddleName', '$parentLastName', '$mobileNumber');";

        if ($conn->query($parentQuery) === TRUE) {
            $result = "New record created successfully!";

        } else {
            $result = "Error: " . $parentQuery . "<br>" . $conn->error;
        }

        print_r($result);
    }
    //student parent pairing
    if($_POST["requestType"] == "Pairing"){
        $studentNumberPair = $_POST["studentNumberPair"];
        $parentNumberPair = $_POST["parentNumberPair"];

        $pairingQuery = "INSERT INTO `studentparentTBL` (`studentNumber`, `parentID`) 
        VALUES ('$studentNumberPair', '$parentNumberPair');";

        if ($conn->query($pairingQuery) === TRUE) {
            $result = "New record created successfully!";

        } else {
            $result = "Error: " . $pairingQuery . "<br>" . $conn->error;
        }

        print_r($result);
    }
}

?>