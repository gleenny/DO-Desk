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
        <link rel="stylesheet" href="../CSS/DODESK-InsertingDetails.css">
        <!--Script-->
        <!--<link rel="stylesheet" href="styles.css">-->
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
    
        <!--first box-->
        <div class="user-box first-box" style="--delay: .6s">
            <!--searching violations-->
            <form id="searchForm">
              <input class="textType" type="text" name="searchNumber" id="searchNumber" placeholder="Student Number">
              <input class="textType" type="text" name="searchName" id="searchName" placeholder="Student Name">
              <select class="textType" name="searchCourse" id="searchCourse" value=" ">
                <option value=""> </option>
              </select>
              <select class="textType" name="status" id="status" value=" ">
                <option value=""> </option>
                  <option value="1">Enrolled</option>
                  <option value="0">Not ernolled</option>
              </select>
              <button type="submit" id="searchbtn" class="searchbutton">Search</button>
            </form>
        </div> 
        
        <!--second box -->
        <div class="user-box second-box" >
            <button class="cards-button button" id="btnStudent" style="--delay: .7s">Register Student</button>
            <button class="cards-button button" id="btnParent" style="--delay: .7s">Register Parent</button>
            <button class="cards-button button" id="btnPairing" style="--delay: .7s">Pairing Parent Student</button>
            <!-- The Modal Register Violation -->
              <div id="modalStudent" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                  <!--Adding Students-->
                  <p style="font-weight: bold;">Register Student</p>
                    <form action="../JAVASCRIPT/addStudentsJS.js" enctype="multipart/form-data" method="POST" id="myformStudent">
                        <input type="text" placeholder="Student Number" id="studentNumber">
                        <input type="text" placeholder="First Name" id="studentfirstName">
                        <input type="text" placeholder="Middle Name" id="studentMiddleName">
                        <input type="text" placeholder="Last Name" id="studentLastName">
                        <select class="textType" name="course" id="course" value=" ">
                        </select>
                        <input type="submit" value="Submit Student" name="submit">
                    </form>
                    <br>
                    <p style="font-weight: bold;">Batch upload student data</p>
                    <input id="studentExcel" type="file" accept=".xlsx, .xls">
                    <input id="submitStudentExcel" type="submit" value="submit student excel">
                </div>
              </div>
              <div id="modalParent" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                 <!--Add Parent--> 
                 <p style="font-weight: bold;">Register Parent</lapbel> 
                    <form action="../JAVASCRIPT/addStudentsJS.js" enctype="multipart/form-data" method="POST" id="myformParent">
                        <input type="text" placeholder="First Name" id="parentfirstName">
                        <input type="text" placeholder="Middle Name" id="parentMiddleName">
                        <input type="text" placeholder="Last Name" id="parentLastName">
                        <input type="text" placeholder="Mobile Number" id="mobileNumber">
                        <input type="submit" value="Submit Parent" name="submit">
                    </form>
                    <br>
                    <p style="font-weight: bold;">Batch upload parent data</p>
                    <input id="parentExcel" type="file" accept=".xlsx, .xls">
                    <input id="submitParentExcel" type="submit" value="submit parent excel">
                </div>
              </div>
              <div id="modalPairing" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                <!--Student Parent Pairing--> 
                <p style="font-weight: bold;">Pair Students and Parent</p> 
                  <form action="../JAVASCRIPT/addStudentsJS.js" enctype="multipart/form-data" method="POST" id="myformPairing">
                    <label for="studentNumberPair">Student Number</label>
                      <select class="textType" name="studentNumberPair" id="studentNumberPair" value=" ">
                      </select><br>
                    <label for="parentNumberPair">Parent ID</label>
                      <select class="textType" name="parentNumberPair" id="parentNumberPair" value=" ">
                      </select>
                      <input class="modalbtnSubmit"type="submit" value="Submit Pairing" name="submit"> 
                      <br>
                      <p style="font-weight: bold;">Batch upload parent data</p>
                      <input id="studentParentExcel" type="file" accept=".xlsx, .xls">
                      <input id="submitStudentParentExcel" type="submit" value="submit pairing excel">
                  </form>
                </div>
              </div>
        </div>

         <!--Third Flow-->
         <div class="user-box third-box">
          <!--List Module-->
          <div class="cards-wrapper" style="--delay: 1s">

            <div class="cards-header">
              <div class="cards-view">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                <rect x="3" y="4" width="16" height="16" rx="2" ry="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                
                <span style="font-weight: bold;" class="today"> Student List</span>
              </div>
            </div>

            <div class="studentlist card">
              <table class="table">
                <thead>
                <tr>
                  <th>Student number</th>
                  <th>Student Name</th>
                  <th>Course</th>
                  <th>Status</th>
                </tr>
                </thead>

                <tbody id="studentListRows">
                </tbody>
              </table>
            </div>
           </div>

          <!--END OF PARENT TABLE-->
        </div>

        <div class="user-box fourth-box">
                    <!--START OF PARENT TABLE-->
           <!--List Module-->
           <div class="cards-wrapper" style="--delay: 1s">
            <div class="cards-header">
              <div class="cards-view">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                <rect x="3" y="4" width="16" height="16" rx="2" ry="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                
                <span style="font-weight: bold;" class="today">Parent List</span>
              </div>
            </div>

            <div class="parentList card">
              <table class="table">
                <thead>
                <tr>
                  <th>Parent ID</th>
                  <th>Parent Name
                  <th>Mobile Number</th>
                  <th>Child</th>
                </tr>
                </thead>

                <tbody id="parentListRows">
                </tbody>
              </table>
            </div>
          </div>
        </div>

          <!-- Snackbar element -->
          <div id="snackbar"></div>
    <!--adding student script-->
    <script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>
    <script src="../JAVASCRIPT/DODeskStudentsJS.js"></script>    
    <!--<script src="script.js"></script>-->
</body>
</html>