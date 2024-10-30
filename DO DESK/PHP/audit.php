<?php

session_start(); // Start the session
require_once 'connections.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT `audittbl`.*,
            `accounttbl`.`personID`,
             `usertbl`.`firstName`,
              `usertbl`.`lastName`,
               `usertbl`.`role`
            FROM `audittbl` 
            LEFT JOIN `accounttbl` ON `audittbl`.`userID` = `accounttbl`.`userID` 
            LEFT JOIN `usertbl` ON `accounttbl`.`personID` = `usertbl`.`personID`
            ORDER BY `audittbl`.`transactionDateTime` DESC;";

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