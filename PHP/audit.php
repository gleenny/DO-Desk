<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT `auditTBL`.*,
            `accountTBL`.`personID`,
             `userTBL`.`firstName`,
              `userTBL`.`lastName`,
               `userTBL`.`role`
            FROM `auditTBL` 
            LEFT JOIN `accountTBL` ON `auditTBL`.`userID` = `accountTBL`.`userID` 
            LEFT JOIN `userTBL` ON `accountTBL`.`personID` = `userTBL`.`personID`
            ORDER BY `auditTBL`.`transactionDateTime` DESC;";

    $result = $conn->query($query);
    $searchResults = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchResults["logID"][] = $row['logID'];
            $searchResults["userID"][] = $row['userID'];
            $searchResults["dateTime"][] = $row['transactionDateTime'];
            $searchResults["process"][] = $row['process'];
            $searchResults["note"][] = $row['note'];
            $searchResults["personID"][] = $row['personID'];
            $searchResults["firstName"][] = $row['firstName'];
            $searchResults["lastName"][] = $row['lastName'];
            $searchResults["role"][] = $row['role'];
        }
    }

    echo json_encode($searchResults);
    }

?>