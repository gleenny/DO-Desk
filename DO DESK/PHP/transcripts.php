<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST["requestType"] == "getTranscripts"){
        $violationID = $_POST["violationID"];

        $sql = "SELECT `transcripttbl`.*,
         `violationtbl`.`studentNumber`,
          `studenttbl`.`firstName`,
           `studenttbl`.`middleName`,
            `studenttbl`.`lastName`,
             `violationtbl`.`offenseID`,
              `offensetbl`.`offense` AS `violationCase`,
               `offensetbl`.`violationType`,
                `violationtbl`.`active`,
                 `violationtbl`.`violationDate`
        FROM `transcripttbl` 
        LEFT JOIN `violationtbl` ON `transcripttbl`.`violationID` = `violationtbl`.`violationID` 
        LEFT JOIN `studenttbl` ON `violationtbl`.`studentNumber` = `studenttbl`.`studentNumber` 
        LEFT JOIN `offensetbl` ON `violationtbl`.`offenseID` = `offensetbl`.`offenseID`
        WHERE `violationtbl`.`violationID` LIKE '$violationID'";

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