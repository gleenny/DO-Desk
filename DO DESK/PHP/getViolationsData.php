<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $cases = [];

    $query = "SELECT `violationtbl`.*,
     `studenttbl`.`firstName`,
     `studenttbl`.`middleName`,
     `studenttbl`.`lastName`,
     `studenttbl`.`course`,
     `studenttbl`.`section`,
     
     `usertbl`.`lastName` AS `Officer`

    FROM `violationtbl` 
	LEFT JOIN `studenttbl` ON `violationtbl`.`studentNumber` = `studenttbl`.`studentNumber` 
	LEFT JOIN `usertbl` ON `violationtbl`.`recordedBy` = `usertbl`.`personID`;";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $cases["violationID"][] = $row['violationID'];
            $cases["violationType"][] = $row['violationType'];
            $cases["violationCase"][] = $row['violationCase'];
            $cases["studentNumber"][] = $row['studentNumber'];
            $cases["active"][] = $row['active'];
            $cases["recordedBy"][] = $row['recordedBy'];
            $cases["firstName"][] = $row['firstName'];
            $cases["middleName"][] = $row['middleName'];
            $cases["lastName"][] = $row['lastName'];
            $cases["course"][] = $row['course'];
            $cases["section"][] = $row['section'];
            $cases["Officer"][] = $row['Officer'];
        }
        print_r (json_encode($cases));
        //print_r ($cases);
    }


        
    $conn->close();
}

?>