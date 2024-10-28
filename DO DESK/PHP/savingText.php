<?php

session_start(); // Start the session
require_once 'connections.php';

$txtPath = "../txt/";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST["requestType"] == "uploadText"){
        //creating text file
        $fileName = $_POST["fileName"];
        $fileExtension = $_POST["fileExtension"];
        $violationID = $_POST["violationID"];

        $myFile = fopen($txtPath.$fileName.".txt", "w") or die("file error");
        fwrite($myFile, $_POST["textContent"]);
        fclose($myFile);
        echo "File has been uploaded";

        //saving in db
        $query = "INSERT INTO `transcripttbl` (`transcriptID`, `transcriptName`, `fileExtension`, `violationID`) 
                VALUES (NULL, '$fileName', '$fileExtension', '$violationID');";
        
        if($conn->query($query) === TRUE) {
            echo "file has been saved";

            //audit
            $dateTime = date("Y-m-d H:i:s");
            $userID = $_SESSION['userID'];
            $auditQuery = "INSERT INTO `audittbl` (`logID`, `userID`, `transactionDateTime`, `process`, `note`) 
            VALUES (NULL, '$userID', '$dateTime', 'saved transcription', 'violationID: $violationID - file Name: $fileName');";
            $audit = $conn->prepare($auditQuery);
            $audit->execute();
        }
        else{
            echo "Error: " . $query . "<br>" . $conn->error;
        } 
        $conn->close();
    }
}

?>