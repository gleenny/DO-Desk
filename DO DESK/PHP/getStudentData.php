<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $students = [];

    $query = "SELECT `studentTBL`.*,
     `studentparentTBL`.`parentID`,
      `parentTBL`.`firstName` AS `parentFirst`,
       `parentTBL`.`middleName` AS `parentMiddle`,
        `parentTBL`.`lastName` AS `parentLast`,
         `parentTBL`.`mobileNumber`
    FROM `studentTBL` 
	LEFT JOIN `studentparentTBL` ON `studentparentTBL`.`studentNumber` = `studentTBL`.`studentNumber` 
	LEFT JOIN `parentTBL` ON `studentparentTBL`.`parentID` = `parentTBL`.`parentID`;";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $students["studentNumber"][] = $row['studentNumber'];
            $students["firstName"][] = $row['firstName'];
            $students["middleName"][] = $row['middleName'];
            $students["lastName"][] = $row['lastName'];
            $students["course"][] = $row['course'];
            $students["section"][] = $row['section'];
            $students["active"][] = $row['active'];
            $students["parentID"][] = $row['parentID'];
            $students["parentFirst"][] = $row['parentFirst'];
            $students["parentMiddle"][] = $row['parentMiddle'];
            $students["parentLast"][] = $row['parentLast'];
            $students["mobileNumber"][] = $row['mobileNumber'];
        }
        print_r (json_encode($students));
        //print_r ($students["studentNumber"]);
    }
    
    $conn->close();
}

?>