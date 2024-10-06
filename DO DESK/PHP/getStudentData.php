<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $students = [];

    $query = "SELECT `studenttbl`.*,
     `studentparenttbl`.`parentID`,
      `parenttbl`.`firstName` AS `parentFirst`,
       `parenttbl`.`middleName` AS `parentMiddle`,
        `parenttbl`.`lastName` AS `parentLast`,
         `parenttbl`.`mobileNumber`
    FROM `studenttbl` 
	LEFT JOIN `studentparenttbl` ON `studentparenttbl`.`studentNumber` = `studenttbl`.`studentNumber` 
	LEFT JOIN `parenttbl` ON `studentparenttbl`.`parentID` = `parenttbl`.`parentID`;";

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