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

        if(empty($_POST["middleName"])){
            $parentQuery = "INSERT INTO `parentTBL` (`parentID`, `firstName`, `middleName`, `lastName`, `mobileNumber`) 
            VALUES (NULL, '$parentFirstName', NULL, '$parentLastName', '$mobileNumber');";
            echo "hello";
        }else{
            $parentQuery = "INSERT INTO `parentTBL` (`parentID`, `firstName`, `middleName`, `lastName`, `mobileNumber`) 
            VALUES (NULL, '$parentFirstName', '$parentMiddleName', '$parentLastName', '$mobileNumber');";
            echo "world";
        }

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
    //search students
    if($_POST["requestType"] == "searchStudent"){
        $conditionCounter = 0;

        $studentNumber = $_POST["searchNumber"];
        $studentName = $_POST["searchName"];
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
        $sql = "SELECT `studentTBL`.* FROM `studenttbl`
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
                $sql .= "`studentTBL`.`course` LIKE '%$searchCourse%'";
                $course = "";
            }
            else if(!($active == "")){
                $sql .= "`studentTBL`.`section` LIKE '%$searchSection%'";
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
    //search parent
    if($_POST["requestType"] == "searchParent"){
        $conditionCounter = 0;

        $studentNumber = $_POST["searchNumber"];
        $studentName = $_POST["searchName"];
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
        $sql = "SELECT `parenttbl`.*,
         `studentparenttbl`.`studentNumber`,
          `studenttbl`.`firstName` AS `studentFirst`,
           `studenttbl`.`middleName` AS `studentMiddle`,
            `studenttbl`.`lastName` AS `studentLast`,
             `studenttbl`.`course`,
              `studenttbl`.`active`
        FROM `parenttbl` 
        LEFT JOIN `studentparenttbl` ON `studentparenttbl`.`parentID` = `parenttbl`.`parentID` 
        LEFT JOIN `studenttbl` ON `studentparenttbl`.`studentNumber` = `studenttbl`.`studentNumber`
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
                $sql .= "`studentTBL`.`course` LIKE '%$searchCourse%'";
                $course = "";
            }
            else if(!($active == "")){
                $sql .= "`studentTBL`.`section` LIKE '%$searchSection%'";
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
        $query = "SELECT `parenttbl`.*,
        `studentparenttbl`.`studentNumber`,
         `studenttbl`.`firstName` AS `studentFirst`,
          `studenttbl`.`middleName` AS `studentMiddle`,
           `studenttbl`.`lastName` AS `studentLast`
       FROM `parenttbl` 
       LEFT JOIN `studentparenttbl` ON `studentparenttbl`.`parentID` = `parenttbl`.`parentID` 
       LEFT JOIN `studenttbl` ON `studentparenttbl`.`studentNumber` = `studenttbl`.`studentNumber`;";
   
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