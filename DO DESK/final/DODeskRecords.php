<?php if(!isset($_SESSION)){
  session_start();
} // Start the session ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DO DESK: Disciplinary Office Management System</title>
    
    <link rel="icon" type="image/x-icon" href="/PICTURE/DoDeskViolet.png">
    <!--Font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!--font-->
        <link rel="stylesheet" href="../CSS/poppinsFont.css">
        <!--Page Style-->
        <link rel="stylesheet" href="../CSS/DODesk-RecordsStyle.css">
        <style>
          body {
              margin: 0;
              scrollbar-width: thin;
              scrollbar-color: #1a1b3c #11132c;
          }
  
          body::-webkit-scrollbar {
              width: 1px;
          }
  
          body::-webkit-scrollbar-track {
              background: #f1f1f1;
          }
  
          body::-webkit-scrollbar-thumb {
              background: purple;
              border-radius: 2px;
          }
  
          body::-webkit-scrollbar-thumb:hover {
              background: #800080;
          }
      </style>
</head>
<body>
  <!--Checks if dumaan sa login-->
  <?php
    if(!isset($_SESSION['userID']) || $_SESSION['userID'] === ''){ ?>
      <script>window.location.href = "DODeskLogin.php";</script>
    <?php }
  ?>
    <!--Left side nav-->
    <div class="wrapper">
      <?php
        require_once 'userHeader.php';
      ?>
        <!--First Flow-->
        <div class="user-box first-box" style="--delay: .6s">
            <!--searching violations-->
            <form id="searchForm">
              <input class="textType" type="text" name="searchNumber" id="searchNumber" placeholder="Student Number">
              <input class="textType" type="text" name="searchName" id="searchName" placeholder="Student Name">
              <input class="textType" type="text" name="searchCourse" id="searchCourse" placeholder="Course">
              <input class="textType" type="text" name="searchSection" id="searchSection" placeholder="Section">
              <select class="textType" name="typeOfViolation" id="typeOfViolation" value=" ">
                <option value=""> </option>
                  <option value="Minor">Minor</option>
                  <option value="Major">Major</option>
              </select>
              <input class="textType" type="text" name="searchCase" id="searchCase" placeholder="Case">
              <select class="textType" name="status" id="status" value=" ">
                <option value=""> </option>
                  <option value="Resolve">Resolve</option>
                  <option value="Unresolve">Unresolve</option>
              </select>
              <input class="textType" type="date" name="searchDate" id="searchDate" placeholder="Date">
              <button type="submit" id="searchbtn" class="searchbutton">Search</button>
            </form>
        </div>  
        <!--Second Flow-->
        <div class="user-box second-box" style="--delay: .6s">
          <!-- Trigger/Open The Modal -->

            <button class="cards-button button" id="btnSubmit">Submit Violation</button>

            <!-- The Modal Register Violation -->
            <div id="modalSubmit" class="modal">

              <!-- Modal content -->
              <div class="modal-content">
                <span class="close">&times;</span>
                <!--Adding Violations-->
                  <form action="../JAVASCRIPT/DODesk-RecordsJS.js" enctype="multipart/form-data" method="POST" id="myform">
                    <div class="title">Sumbit Violation</div>
                    <input type="text" placeholder="Student Number" id="studentNumber">
                    <select name="violationType" id="violationType" value=" ">
                      <option value="Minor">Minor</option>
                      <option value="Major">Major</option>
                    </select>
                    <input type="text" placeholder="Violation Case" id="violationCase">
                    <input type="submit" value="Submit Violation" name="submit" > 
                  </form>
              </div>
            </div>

        <!--updating violation status-->
        <!-- Trigger/Open The Modal -->
            <button class="cards-button button" id="btnUpdate">Update Status</button>

            <!-- The Modal -->
            <div id="modalUpdate" class="modal">
              <!-- Modal content -->
              <div class="modal-content">
                <span class="close">&times;</span>
                <form action="../JAVASCRIPT/DODesk-RecordsJS.js" enctype="multipart/form-data" method="POST" id="updateStatusForm">
                  <div class="title">Update Status</div>
                  <input type="text" placeholder="violationID" id="violationID">
                  <select name="violationStatus" id="violationStatus" value=" ">
                      <option value="Resolve">Resolve</option>
                      <option value="Unresolve">Unresolve</option>
                  </select>
                  <input type="submit" value="Update Status" name="submit" >
                </form>
               </div>
            </div>
      </div>
      
        <!--Second Flow-->
        <div class="user-box third-box">
          <!--3:First module-->

          <!--List Module-->
          <div class="cards-wrapper" style="--delay: 1s">
            <div class="cards-header">
              
            <div class="cards-view">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
              <rect x="3" y="4" width="16" height="16" rx="2" ry="2" />
              <path d="M16 2v4M8 2v4M3 10h18" />
              </svg>
              
              <span class="today"> Report List</span>
            </div>
            </div>
            <div class="cards card">
            <table class="table">
              <thead>
              <tr>
                <th>Violation ID</th>
                <th>Record By</th>
                <th>Student number</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Section</th>
                <th>Type Of Violation</th>
                <th>Case</th>
                <th>Status</th>
                <th>Date</th>
              </tr>
              </thead>

              <tbody id="reportListRows">
              </tbody>
            </table>
            </div>
          </div>
          
        </div>
        <script src="../JAVASCRIPT/DODeskRecordsJS.js"></script>
</body>
</html>