<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //search violations
    if($_POST["requestType"] == "searchSanction"){
        $conditionCounter = 0;

        $sanctionID = $_POST['sanctionID'];
        $studentNumber = $_POST['studentNumber'];
        $studentName = $_POST['studentName'];
        $violationID = $_POST['violationID'];
        $violationCase = $_POST['violationCase'];
        $sanction = $_POST['sanction'];
        $status = $_POST['status'];

        if(!($sanctionID == "")){
            $conditionCounter++;
        }
        if(!($studentNumber == "")){
            $conditionCounter++;
        }
        if(!($studentName == "")){
            $conditionCounter++;
        }
        if(!($violationID == "")){
            $conditionCounter++;
        }
        if(!($violationCase == "")){
            $conditionCounter++;
        }
        if(!($sanction == "")){
            $conditionCounter++;
        }
        if(!($status == "")){
            $conditionCounter++;
        }
        // SQL query
        $sql = "SELECT `sanctiontbl`.*,
                `accounttbl`.`personID`,
                `usertbl`.`firstName`,
                `usertbl`.`lastName`,
                    `violationtbl`.`studentNumber`,
                    `studenttbl`.`firstName` AS `studentFirst`,
                    `studenttbl`.`middleName` AS `studentMiddle`,
                    `studenttbl`.`lastName` AS `studentLast`,
                        `offensetbl`.`offense` AS `violationCase`,
                        `punishmenttbl`.`sanction`
                FROM `sanctiontbl` 
                LEFT JOIN `accounttbl` ON `sanctiontbl`.`recordedBy` = `accounttbl`.`userID` 
                LEFT JOIN `usertbl` ON `accounttbl`.`personID` = `usertbl`.`personID` 
                LEFT JOIN `violationtbl` ON `sanctiontbl`.`violationID` = `violationtbl`.`violationID` 
                LEFT JOIN `studenttbl` ON `violationtbl`.`studentNumber` = `studenttbl`.`studentNumber` 
                LEFT JOIN `offensetbl` ON `violationtbl`.`offenseID` = `offensetbl`.`offenseID` 
                LEFT JOIN `punishmenttbl` ON `sanctiontbl`.`sanction` = `punishmenttbl`.`sanctionID`
                WHERE ";

        for($i = 0; $i < $conditionCounter; $i++){
            if($i >= 1){
                $sql .= " AND ";
            }
            
            if(!($sanctionID == "")){
                $sql .= "`sanctionTBL`.`sanctionID` LIKE '%$sanctionID%'";
                $sanctionID = "";
            }
            else if(!($studentNumber == "")){
                $sql .= "`violationTBL`.`studentNumber` LIKE '%$studentNumber%'";
                $studentNumber = "";
            }
            else if(!($studentName == "")){
                $sql .= "CONCAT(`studentTBL`.`firstName`, COALESCE(`studentTBL`.`middleName`, ''), `studentTBL`.`lastName`) LIKE '%$studentName%'";
                $studentName = "";
            }
            else if(!($violationID == "")){
                $sql .= "`violationTBL`.`violationID` LIKE '%$violationID%'";
                $violationID = "";
            }
            else if(!($violationCase == "")){
                $sql .= "`offenseTBL`.`offense` LIKE '%$violationCase%'";
                $violationCase = "";
            }
            else if(!($sanction == "")){
                $sql .= "`punishmentTBL`.`sanction` LIKE '%$sanction%'";
                $sanction = "";
            }
            else if(!($status == "")){
                $sql .= "`sanctionTBL`.`active` LIKE '%$status%'";
                $status = "";
            }
        }
        $sql .= "ORDER BY `sanctiontbl`.`sanctionID` DESC";

        $result = $conn->query($sql);
        $sanctions = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sanctions["sanctionID"][] = $row['sanctionID'];
                $sanctions["firstName"][] = $row['firstName'];
                $sanctions["lastName"][] = $row['lastName'];
                $sanctions["studentNumber"][] = $row['studentNumber'];
                $sanctions["studentFirst"][] = $row['studentFirst'];
                $sanctions["studentMiddle"][] = $row['studentMiddle'];
                $sanctions["studentLast"][] = $row['studentLast'];
                $sanctions["violationID"][] = $row['violationID'];
                $sanctions["violationCase"][] = $row['violationCase'];
                $sanctions["sanction"][] = $row['sanction'];
                $sanctions["status"][] = $row['active'];
                $sanctions["date"][] = $row['date'];
            }
        }
        echo json_encode($sanctions);

        $conn->close();
    }
    if($_POST["requestType"] == "addSanction"){
        $violationID = $_POST["violationID"];
        $sanction = $_POST["sanction"];
        $doID = $_SESSION["userID"];
        $currentDate = date("Y-m-d");
        
        $sanctionIDQuery = "SELECT `punishmentTBL`.*
        FROM `punishmentTBL`
        WHERE `punishmentTBL`.`sanction` LIKE '$sanction';";

        $result = $conn->query($sanctionIDQuery);

        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $sanctionID = $row['sanctionID'];
            }
        }

        $query = "INSERT INTO `sanctiontbl` (`sanctionID`, `violationID`, `sanction`, `active`, `recordedBy`, `date`) 
        VALUES (NULL, '$violationID', '$sanctionID', '1', '$doID', '$currentDate');";
    
        if ($conn->query($query) === TRUE) {
            echo "New record created successfully!";

            $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'Added new sanction', 'violation ID: $violationID - sanction: $sanction');";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();
      
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    if($_POST['requestType'] == "updateSanction"){
        $sanctionID = $_POST["sanctionID"];
        $sanctionStatus =  $_POST["sanctionStatus"];;

        $query = "UPDATE `sanctionTBL`
                SET `active` = '$sanctionStatus'
                WHERE `sanctionID` = '$sanctionID'";

        if ($conn->query($query) === TRUE) {
            echo "Data has been updated!";

            $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $auditQuery = "INSERT INTO `auditTBL` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'Changed violation status', 'Sanction ID: $sanctionID - changed into $sanctionStatus');";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();

        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
        $conn->close();
    }
}
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sanctions = [];

    $query = "SELECT `sanctiontbl`.*,
     `accounttbl`.`personID`,
      `usertbl`.`firstName`,
       `usertbl`.`lastName`,
        `violationtbl`.`studentNumber`,
         `studenttbl`.`firstName` AS `studentFirst`,
          `studenttbl`.`middleName` AS `studentMiddle`,
           `studenttbl`.`lastName` AS `studentLast`,
            `offensetbl`.`offense` AS `violationCase`,
             `punishmenttbl`.`sanction`
    FROM `sanctiontbl` 
	LEFT JOIN `accounttbl` ON `sanctiontbl`.`recordedBy` = `accounttbl`.`userID` 
	LEFT JOIN `usertbl` ON `accounttbl`.`personID` = `usertbl`.`personID` 
	LEFT JOIN `violationtbl` ON `sanctiontbl`.`violationID` = `violationtbl`.`violationID` 
	LEFT JOIN `studenttbl` ON `violationtbl`.`studentNumber` = `studenttbl`.`studentNumber` 
	LEFT JOIN `offensetbl` ON `violationtbl`.`offenseID` = `offensetbl`.`offenseID` 
	LEFT JOIN `punishmenttbl` ON `sanctiontbl`.`sanction` = `punishmenttbl`.`sanctionID`
	ORDER BY `sanctiontbl`.`sanctionID` DESC";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $sanctions["sanctionID"][] = $row['sanctionID'];
            $sanctions["firstName"][] = $row['firstName'];
            $sanctions["lastName"][] = $row['lastName'];
            $sanctions["studentNumber"][] = $row['studentNumber'];
            $sanctions["studentFirst"][] = $row['studentFirst'];
            $sanctions["studentMiddle"][] = $row['studentMiddle'];
            $sanctions["studentLast"][] = $row['studentLast'];
            $sanctions["violationID"][] = $row['violationID'];
            $sanctions["violationCase"][] = $row['violationCase'];
            $sanctions["sanction"][] = $row['sanction'];
            $sanctions["status"][] = $row['active'];
            $sanctions["date"][] = $row['date'];
        }
        print_r (json_encode($sanctions));
    }     
    $conn->close();
}


?>