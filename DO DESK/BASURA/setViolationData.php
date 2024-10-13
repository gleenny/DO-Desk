<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($_POST['requestType'] == "addViolation"){
        $violationType = $_POST["violationType"];
        $violationCase = $_POST["violationCase"];
        $studentNumber = $_POST["studentNumber"];
        
    
        $query = "INSERT INTO `violationtbl` (`violationID`, `violationType`, `violationCase`, `studentNumber`, `active`, `recordedBy`) 
        VALUES (NULL, '$violationType', '$violationCase', '$studentNumber', '1', '1000101');";
    
        if ($conn->query($query) === TRUE) {
            echo "New record created successfully!";
      
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    
        print_r("hello " . $violationType);
    
        $conn->close();
    }
}

?>
