<?php
session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($_POST['requestType'] == "searchParent"){
        $studentName = $_POST["studentName"];
        $students = [];

        $parentQuery = "SELECT `studentTBL`.`studentNumber`,
         `studentTBL`.`firstName`,
          `studentTBL`.`middleName`,
           `studentTBL`.`lastName`,
            `studentparentTBL`.`parentID`,
             `parentTBL`.`firstName` AS `parentFirst`,
              `parentTBL`.`middleName` AS `parentMiddle`,
               `parentTBL`.`lastName` AS `parentLast`,
                `parentTBL`.`mobileNumber`
        FROM `studentTBL` 
            LEFT JOIN `studentparentTBL` ON `studentparentTBL`.`studentNumber` = `studentTBL`.`studentNumber` 
            LEFT JOIN `parentTBL` ON `studentparentTBL`.`parentID` = `parentTBL`.`parentID`
            WHERE CONCAT(`studentTBL`.`firstName`, COALESCE(`studentTBL`.`middleName`, ''), `studentTBL`.`lastName`)  LIKE '%$studentName%';";

    $result = $conn->query($parentQuery);

    if ($result->num_rows > 0) {
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $students["studentNumber"][] = $row['studentNumber'];
                $students["firstName"][] = $row['firstName'];
                $students["middleName"][] = $row['middleName'];
                $students["lastName"][] = $row['lastName'];
                $students["parentFirst"][] = $row['parentFirst'];
                $students["parentMiddle"][] = $row['parentMiddle'];
                $students["parentLast"][] = $row['parentLast'];
                $students["mobileNumber"][] = $row['mobileNumber'];
            }
            print_r (json_encode($students));
        }
    }

    }
    if($_POST['requestType'] == "sendMessage"){
        $studentNumber = $_POST["studentNumber"];
        $message = $_POST["message"];

        $numberQuery = "SELECT `studentTBL`.`studentNumber`, `studentparentTBL`.`parentID`, `parentTBL`.`mobileNumber`
            FROM `studentTBL` 
            LEFT JOIN `studentparentTBL` ON `studentparentTBL`.`studentNumber` = `studentTBL`.`studentNumber` 
            LEFT JOIN `parentTBL` ON `studentparentTBL`.`parentID` = `parentTBL`.`parentID`
            WHERE `studentTBL`.`studentNumber` LIKE '$studentNumber';";

        $result = $conn->query($numberQuery);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $mobileNumbers[] = $row['mobileNumber'];
            }
            print_r(sizeof($mobileNumbers));
            print_r($mobileNumbers);
        } 

        for($i = 0; $i < sizeof($mobileNumbers); $i++){
            $ch = curl_init();
            $parameters = array(
                'apikey' => SEMAPHOREAPIKEY, //Your API KEY
                'number' => $mobileNumbers[$i], //message to
                'message' => $message,
                'sendername' => 'DODesk' //APPROVED NA, SANA SA ENDORSEMENT DIN
            );
            curl_setopt( $ch, CURLOPT_URL,'https://api.semaphore.co/api/v4/messages' );
            curl_setopt( $ch, CURLOPT_POST, 1 );
            
            //Send the parameters set above with the request
            curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );
            
            // Receive response from server
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $output = curl_exec( $ch );
            curl_close ($ch);
            
            //Show the server response
            echo $output;
        }
    }
}




?>
