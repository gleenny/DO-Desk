<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
               $students["studentNumber"][] = $row['studentNumber'];
               $students["studentMiddle"][] = $row['studentMiddle'];
               $students["studentLast"][] = $row['studentLast'];
           }
           echo json_encode($students);
       }     
       $conn->close();
    }
}

?>