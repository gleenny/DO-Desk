<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //adding students
    if($_POST["requestType"] == "Students"){
        $studentNumber = $_POST["studentNumber"];
        $studentFirstName = $_POST["firstName"];
        if($_POST["middleName"] == "null"){
            $studentMiddleName = "";
        }else {
            $studentMiddleName = $_POST["middleName"];
        }
        $studentLastName = $_POST["lastName"];
        $course = $_POST["course"];
        $active = $_POST["active"];

        if(empty($_POST["middleName"])){
            $studentQuery = "INSERT INTO `studentTBL` (`studentNumber`, `firstName`, `middleName`, `lastName`, `course`, `active`) 
            VALUES ('$studentNumber', '$studentFirstName', NULL, '$studentLastName', '$course', '$active');";
        }else{
            $studentQuery = "INSERT INTO `studentTBL` (`studentNumber`, `firstName`, `middleName`, `lastName`, `course`, `active`) 
            VALUES ('$studentNumber', '$studentFirstName', '$studentMiddleName', '$studentLastName', '$course', '$active');";
        }

        if ($conn->query($studentQuery) === TRUE) {
            $result = "New record created successfully!";

            $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'Added Student', 'student number: $studentNumber');";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();

        } else {
            $result = "Error: " . $studentQuery . "<br>" . $conn->error;
        }

        print_r($result);
    }
    //adding parents
    if($_POST["requestType"] == "Parents"){
        $parentFirstName = $_POST["firstName"];
        if($_POST["middleName"] == "null"){
            $parentMiddleName = "";
        }else {
            $parentMiddleName = $_POST["middleName"];
        }
        $parentLastName = $_POST["lastName"];
        $mobileNumber = $_POST["mobileNumber"];

        if(empty($_POST["middleName"])){
            $parentQuery = "INSERT INTO `parentTBL` (`parentID`, `firstName`, `middleName`, `lastName`, `mobileNumber`) 
            VALUES (NULL, '$parentFirstName', NULL, '$parentLastName', '$mobileNumber');";
            echo "hello";
        }else{
            $parentQuery = "INSERT INTO `parentTBL` (`parentID`, `firstName`, `middleName`, `lastName`, `mobileNumber`) 
            VALUES (NULL, '$parentFirstName', '$parentMiddleName', '$parentLastName', '$mobileNumber');";
        }

        if ($conn->query($parentQuery) === TRUE) {
            $result = "New record created successfully!";

            $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'Added Parent', '$parentFirstName $parentLastName');";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();

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

            $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'Student Paired With Parent', '$studentNumberPair : $parentNumberPair');";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();

        } else {
            $result = "Error: " . $pairingQuery . "<br>" . $conn->error;
        }

        print_r($result);
    }
    //search students
    if($_POST["requestType"] == "searchStudent"){
        $conditionCounter = 0;

        $studentNumber = $_POST["searchNumber"];
        $studentName = str_ireplace(' ', '%', $_POST['searchName']);
        $course = $_POST["course"];
        $active = $_POST["status"];

        if(!($studentNumber == "")){
            $conditionCounter++;
        }
        if(!($studentName == "")){
            $conditionCounter++;
        }
        if(!($course == "")){
            $conditionCounter++;
        }
        if(!($active == "")){
            $conditionCounter++;
        }
        // SQL query
        $sql = "SELECT `studentTBL`.* FROM `studentTBL`
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
            else if(!($course == "")){
                $sql .= "`studentTBL`.`course` LIKE '%$course%'";
                $course = "";
            }
            else if(!($active == "")){
                $sql .= "`studentTBL`.`active` LIKE '%$active%'";
                $active = "";
            }
            
        }
        $sql .= " ORDER BY `studentTBL`.`studentNumber` ASC;";

        $result = $conn->query($sql);
        $searchResults = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults["studentNumber"][] = $row['studentNumber'];
                $searchResults["firstName"][] = $row['firstName'];
                $searchResults["middleName"][] = $row['middleName'];
                $searchResults["lastName"][] = $row['lastName'];
                $searchResults["course"][] = $row['course'];
                $searchResults["active"][] = $row['active'];
            }
        }
        echo json_encode($searchResults);

        $conn->close();
    }
    //search parent info
    if($_POST["requestType"] == "searchParentInfo"){
        $conditionCounter = 0;

        $parentID = $_POST["parentID"];
        $parentName = str_ireplace(' ', '%', $_POST['parentName']);
        $mobileNumber = $_POST["mobileNumber"];

        if(!($parentID == "")){
            $conditionCounter++;
        }
        if(!($parentName == "")){
            $conditionCounter++;
        }
        if(!($mobileNumber == "")){
            $conditionCounter++;
        }
        // SQL query
        $sql = "SELECT `parentTBL`.*,
         `studentparentTBL`.`studentNumber`,
          `studentTBL`.`firstName` AS `studentFirst`,
           `studentTBL`.`middleName` AS `studentMiddle`,
            `studentTBL`.`lastName` AS `studentLast`
                FROM `parentTBL` 
                LEFT JOIN `studentparentTBL` ON `studentparentTBL`.`parentID` = `parentTBL`.`parentID` 
                LEFT JOIN `studentTBL` ON `studentparentTBL`.`studentNumber` = `studentTBL`.`studentNumber` 
        WHERE ";
        for($i = 0; $i < $conditionCounter; $i++){
            if($i >= 1){
                $sql .= " AND ";
            }
            if(!($parentID == "")){
                $sql .= "`parentTBL`.`parentID` LIKE '%$parentID%'";
                $parentID = "";
            }
            else if(!($parentName == "")){
                $sql .= "CONCAT(`parentTBL`.`firstName`, COALESCE(`parentTBL`.`middleName`, ''), `parentTBL`.`lastName`) LIKE '%$parentName%'";
                $parentName = "";
            }
            else if(!($mobileNumber == "")){
                $sql .= "`parentTBL`.`mobileNumber` LIKE '%$mobileNumber%'";
                $mobileNumber = "";
            }
        }
        $sql .= " ORDER BY `parentTBL`.`parentID` ASC;";
        $result = $conn->query($sql);
        $searchResults = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults["parentID"][] = $row['parentID'];
                $searchResults["firstName"][] = $row['firstName'];
                $searchResults["middleName"][] = $row['middleName'];
                $searchResults["lastName"][] = $row['lastName'];
                $searchResults["mobileNumber"][] = $row['mobileNumber'];
                $searchResults["studentFirst"][] = $row['studentFirst'];
                $searchResults["studentMiddle"][] = $row['studentMiddle'];
                $searchResults["studentLast"][] = $row['studentLast'];
            }
        }
        echo json_encode($searchResults);
        $conn->close();
    }
    //search parent
    if($_POST["requestType"] == "searchParent"){
        $conditionCounter = 0;

        $studentNumber = $_POST["searchNumber"];
        $studentName = str_ireplace(' ', '%', $_POST['searchName']);
        $course = $_POST["course"];
        $active = $_POST["status"];

        if(!($studentNumber == "")){
            $conditionCounter++;
        }
        if(!($studentName == "")){
            $conditionCounter++;
        }
        if(!($course == "")){
            $conditionCounter++;
        }
        if(!($active == "")){
            $conditionCounter++;
        }
        // SQL query
        $sql = "SELECT `parentTBL`.*,
         `studentparentTBL`.`studentNumber`,
          `studentTBL`.`firstName` AS `studentFirst`,
           `studentTBL`.`middleName` AS `studentMiddle`,
            `studentTBL`.`lastName` AS `studentLast`,
             `studentTBL`.`course`,
              `studentTBL`.`active`
        FROM `parentTBL` 
        LEFT JOIN `studentparentTBL` ON `studentparentTBL`.`parentID` = `parentTBL`.`parentID` 
        LEFT JOIN `studentTBL` ON `studentparentTBL`.`studentNumber` = `studentTBL`.`studentNumber`
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
            else if(!($course == "")){
                $sql .= "`studentTBL`.`course` LIKE '%$course%'";
                $course = "";
            }
            else if(!($active == "")){
                $sql .= "`studentTBL`.`active` LIKE '%$active%'";
                $active = "";
            }
            
        }
        $sql .= " ORDER BY `studentTBL`.`studentNumber` ASC;";

        $result = $conn->query($sql);
        $parentSearchResults = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $parentSearchResults["parentID"][] = $row['parentID'];
                $parentSearchResults["firstName"][] = $row['firstName'];
                $parentSearchResults["middleName"][] = $row['middleName'];
                $parentSearchResults["lastName"][] = $row['lastName'];
                $parentSearchResults["mobileNumber"][] = $row['mobileNumber'];
                $parentSearchResults["studentFirst"][] = $row['studentFirst'];
                $parentSearchResults["studentMiddle"][] = $row['studentMiddle'];
                $parentSearchResults["studentLast"][] = $row['studentLast'];
            }
        }
        echo json_encode($parentSearchResults);

        $conn->close();
    }
    //get parents info
    if($_POST["requestType"] == "getParents"){
        $query = "SELECT `parentTBL`.*,
        `studentparentTBL`.`studentNumber`,
         `studentTBL`.`firstName` AS `studentFirst`,
          `studentTBL`.`middleName` AS `studentMiddle`,
           `studentTBL`.`lastName` AS `studentLast`
       FROM `parentTBL` 
       LEFT JOIN `studentparentTBL` ON `studentparentTBL`.`parentID` = `parentTBL`.`parentID` 
       LEFT JOIN `studentTBL` ON `studentparentTBL`.`studentNumber` = `studentTBL`.`studentNumber`;";
   
       $result = $conn->query($query);
   
       if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()){
               $students["parentID"][] = $row['parentID'];
               $students["firstName"][] = $row['firstName'];
               $students["middleName"][] = $row['middleName'];
               $students["lastName"][] = $row['lastName'];
               $students["mobileNumber"][] = $row['mobileNumber'];
               $students["studentFirst"][] = $row['studentFirst'];
               $students["studentMiddle"][] = $row['studentMiddle'];
               $students["studentLast"][] = $row['studentLast'];
           }
           echo json_encode($students);
       }     
       $conn->close();
    }
    //get Courses
    if($_POST["requestType"] == "getCourses"){
        $query = "SELECT `courseTBL`.`courseID` FROM `courseTBL`;";
   
       $result = $conn->query($query);
   
       if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()){
               $courses["courses"][] = $row['courseID'];
           }
           echo json_encode($courses);
       }     
       $conn->close();
    }
    if($_POST["requestType"] == "getStudentID"){
        $query = "SELECT `studentTBL`.`studentNumber` FROM `studentTBL`;";
   
       $result = $conn->query($query);
   
       if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()){
               $sNumbers["studentNumber"][] = $row['studentNumber'];
           }
           echo json_encode($sNumbers);
       }     
       $conn->close();
    }
    if($_POST["requestType"] == "getParentID"){
        $query = "SELECT `parentTBL`.`parentID` FROM `parentTBL`;";
   
       $result = $conn->query($query);
   
       if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()){
               $parentID["parentID"][] = $row['parentID'];
           }
           echo json_encode($parentID);
       }     
       $conn->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $query = "SELECT `studentTBL`.* FROM `studentTBL`
    ORDER BY `studentTBL`.`studentNumber` ASC;";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $students["studentNumber"][] = $row['studentNumber'];
            $students["firstName"][] = $row['firstName'];
            $students["middleName"][] = $row['middleName'];
            $students["lastName"][] = $row['lastName'];
            $students["course"][] = $row['course'];
            $students["active"][] = $row['active'];
        }
        echo json_encode($students);
    }     
    $conn->close();
}
?>