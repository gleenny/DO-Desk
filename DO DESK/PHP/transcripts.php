<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST["requestType"] == "getTranscripts"){
        $violationID = $_POST["violationID"];

        $sql = "SELECT `studenttbl`.`firstName`,
         `studenttbl`.`middleName`,
          `studenttbl`.`lastName`,
           `studenttbl`.`studentNumber`,
            `violationtbl`.`violationID`,
             `violationtbl`.`violationCase`,
              `violationtbl`.`violationType`,
               `violationtbl`.`active`,
                `violationtbl`.`violationDate`,
                 `transcripttbl`.`transcriptID`,
                  `transcripttbl`.`transcriptName`,
                   `transcripttbl`.`fileExtension`
                FROM `studenttbl` 
	            LEFT JOIN `violationtbl` ON `violationtbl`.`studentNumber` = `studenttbl`.`studentNumber` 
	            LEFT JOIN `transcripttbl` ON `transcripttbl`.`violationID` = `violationtbl`.`violationID`
                WHERE `transcripttbl`.`transcriptName` IS NOT NULL AND `violationtbl`.`violationID` LIKE '$violationID'";

        $result = $conn->query($sql);
        $searchResults = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $searchResults["firstName"][] = $row['firstName'];
                $searchResults["middleName"][] = $row['middleName'];
                $searchResults["lastName"][] = $row['lastName'];
                $searchResults["studentNumber"][] = $row['studentNumber'];
                $searchResults["violationID"][] = $row['violationID'];
                $searchResults["violationCase"][] = $row['violationCase'];
                $searchResults["violationType"][] = $row['violationType'];
                $searchResults["active"][] = $row['active'];
                $searchResults["violationDate"][] = $row['violationDate'];
                $searchResults["transcriptID"][] = $row['transcriptID'];
                $searchResults["transcriptName"][] = $row['transcriptName'];
                $searchResults["fileExtension"][] = $row['fileExtension'];
            }
        }
        echo json_encode($searchResults);

        $conn->close();
    }
}

?>