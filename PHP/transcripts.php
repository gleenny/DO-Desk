<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST["requestType"] == "getTranscripts"){
        $violationID = $_POST["violationID"];

        $sql = "SELECT `transcriptTBL`.*,
         `violationTBL`.`studentNumber`,
          `studentTBL`.`firstName`,
           `studentTBL`.`middleName`,
            `studentTBL`.`lastName`,
             `violationTBL`.`offenseID`,
              `offenseTBL`.`offense` AS `violationCase`,
               `offenseTBL`.`violationType`,
                `violationTBL`.`active`,
                 `violationTBL`.`violationDate`
        FROM `transcriptTBL` 
        LEFT JOIN `violationTBL` ON `transcriptTBL`.`violationID` = `violationTBL`.`violationID` 
        LEFT JOIN `studentTBL` ON `violationTBL`.`studentNumber` = `studentTBL`.`studentNumber` 
        LEFT JOIN `offenseTBL` ON `violationTBL`.`offenseID` = `offenseTBL`.`offenseID`
        WHERE `violationTBL`.`violationID` LIKE '$violationID'";

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