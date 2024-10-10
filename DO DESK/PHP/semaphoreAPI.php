<?php
session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if($_POST['requestType'] == "searchParent"){
        $studentName = $_POST["studentName"];
        $students = [];

        $parentQuery = "SELECT `studenttbl`.`studentNumber`,
         `studenttbl`.`firstName`,
          `studenttbl`.`middleName`,
           `studenttbl`.`lastName`,
            `studentparenttbl`.`parentID`,
             `parenttbl`.`firstName` AS `parentFirst`,
              `parenttbl`.`middleName` AS `parentMiddle`,
               `parenttbl`.`lastName` AS `parentLast`,
                `parenttbl`.`mobileNumber`
        FROM `studenttbl` 
            LEFT JOIN `studentparenttbl` ON `studentparenttbl`.`studentNumber` = `studenttbl`.`studentNumber` 
            LEFT JOIN `parenttbl` ON `studentparenttbl`.`parentID` = `parenttbl`.`parentID`
            WHERE CONCAT(`studenttbl`.`firstName`, COALESCE(`studenttbl`.`middleName`, ''), `studenttbl`.`lastName`)  LIKE '%$studentName%';";

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

        $numberQuery = "SELECT `studenttbl`.`studentNumber`, `studentparenttbl`.`parentID`, `parenttbl`.`mobileNumber`
            FROM `studenttbl` 
            LEFT JOIN `studentparenttbl` ON `studentparenttbl`.`studentNumber` = `studenttbl`.`studentNumber` 
            LEFT JOIN `parenttbl` ON `studentparenttbl`.`parentID` = `parenttbl`.`parentID`
            WHERE `studenttbl`.`studentNumber` LIKE '$studentNumber';";

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
                'apikey' => 'e1e318783c6fa04008ec10e82affc6b6', //Your API KEY
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
