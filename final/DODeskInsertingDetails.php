<?php if(!isset($_SESSION)){
  session_start();
} // Start the session ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DO DESK: Disciplinary Office Management System</title>
    
    <link rel="icon" type="image/x-icon" href="../PICTURE/DoDeskViolet.png">
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
          <div class="user-box zero-box" style="--delay: .6s">
            <p style="font-weight: bold; "> Search Student</p>
          </div>
        <!--first box-->
        <div class="user-box first-box" style="--delay: .6s"  >

            <div class="form-container">
              <form class="form1" id="searchForm">
                  <div class="form1-row">
                      <div class="form1-group">
                      <!--Student number search -->
                      <input class="textType" type="text" name="searchNumber" id="searchNumber" placeholder="Student Number">
                      </div>
                      <div class="form1-group">
                      <!--Student name search -->
                      <input class="textType" type="text" name="searchName" id="searchName" placeholder="Student Name">
                      </div>
                  </div>
                  
                  <div class="form1-row">
                      <div class="form1-group">
                      <!--Student course search -->
                      <select class="textType" name="searchCourse" id="searchCourse" value=" ">
                    <option value="">Course</option>
                  </select>
                      </div>
                      <div class="form1-group">
                        <!--Student status search -->
                      <select class="textType" name="status" id="status" value=" ">
                        <option value="">Status</option>
                          <option value="1">Enrolled</option>
                          <option value="0">Not ernolled</option>
                      </select>
                      </div>
                  </div>
                  
                  <button type="submit" id="searchbtn" class="searchbutton">Search</button>
              </form>
            </div>
              
            
        </div> 
        
        <!--second box -->
        <div class="user-box second-box" style="--delay: .7s">
          <div class="modalSections">
              <button class="cards-button button" id="btnStudent" style="--delay: .7s">Register Student</button>
          </div>
            <!-- The Modal Register Violation -->
              <div id="modalStudent" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                  <p style="font-weight: bold;">Register Student</p>
                  <!--Adding Students-->
                  <div class="modalform-container">
                    <form class="modalform"action="../JAVASCRIPT/addStudentsJS.js" enctype="multipart/form-data" method="POST" id="myformStudent">
                      <div class="modalform-row">
                        <div class="modalform-group">
                          <input type="text" placeholder="Student Number" id="studentNumber" minlength="10" maxlength="10">
                        </div>
                      </div>  
                      <div class="modalform-row">
                        <div class="modalform-group">
                          <input type="text" placeholder="First Name" id="studentfirstName">
                        </div>
                        <div class="modalform-group">
                          <input type="text" placeholder="Middle Name" id="studentMiddleName">
                        </div>
                      </div>
                      <div class="modalform-row">
                        <div class="modalform-group">
                          <input type="text" placeholder="Last Name" id="studentLastName">
                        </div>
                        <div class="modalform-group">
                          <select name="course" id="course" value=" ">
                          </select>
                        </div>
                      </div>
                        
                        <br>
                        <input class="modalBtn" type="submit" value="Submit Student" name="submit">
                        <br>
                        <p style="font-weight: bold;">Batch upload student data</p>
                        <input id="studentExcel" type="file" accept=".xlsx, .xls">
                        <input class="modalBtn" id="submitStudentExcel" type="submit" value="submit student excel">
                    </form>
                  </div>
                </div>
              </div>
              <div id="modalParent" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                 <!--Add Parent--> 
                 <p style="font-weight: bold;">Register Parent</lapbel>
                 <div class="modalform-container"> 
                    <form class="modalform" action="../JAVASCRIPT/addStudentsJS.js" enctype="multipart/form-data" method="POST" id="myformParent">
                        <div class="modalform-row">
                          <div class="modalform-group">
                            <input type="text" placeholder="First Name" id="parentfirstName">
                          </div>
                          <div class="modalform-group">
                            <input type="text" placeholder="Middle Name" id="parentMiddleName">
                          </div>
                        </div>
                        <div class="modalform-row">
                          <div class="modalform-group">
                          <input type="text" placeholder="Last Name" id="parentLastName">
                          </div>
                          <div class="modalform-group">
                          <input type="text" placeholder="Mobile Number" id="mobileNumber" minlength="10" maxlength="11">
                          </div>
                        </div>
                        <input class="modalBtn"type="submit" value="Submit Parent" name="submit">
                        <br>
                        <p style="font-weight: bold;">Batch upload parent data</p>
                        <input id="parentExcel" type="file" accept=".xlsx, .xls">
                        <input class="modalBtn" id="submitParentExcel" type="submit" value="submit parent excel">
                    </form>
                  </div>
                    
                </div>
              </div>
              <div id="modalPairing" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                <!--Student Parent Pairing--> 
                <p style="font-weight: bold;">Pair Students and Parent</p> 
                <div class="modalform-container">
                  <form class="modalformpair" action="../JAVASCRIPT/addStudentsJS.js" enctype="multipart/form-data" method="POST" id="myformPairing">
                    <div class="modalformpair-row">
                      <div class="modalformpair-group">
                        <label for="studentNumberPair">Student Number</label>
                        <select  name="studentNumberPair" id="studentNumberPair" value=" ">
                        </select>
                      </div>
                    </div>
                    <div class="modalformpair-row">
                      <div class="modalformpair-group">
                        <label for="parentNumberPair">Parent ID</label>
                        <select name="parentNumberPair" id="parentNumberPair" value=" ">
                          <br>
                        </select>
                      </div>
                    </div>
                      <input class="modalBtn" type="submit" value="Submit Pairing" name="submit"> 
                      <br>
                      <p style="font-weight: bold;">Batch upload parent data</p>
                      <input id="studentParentExcel" type="file" accept=".xlsx, .xls">
                      <input class="modalBtn" id="submitStudentParentExcel" type="submit" value="submit pairing excel">
                  </form>
                </div>
                  
                </div>
              </div>
        </div>

         <!--Third Flow-->
         <div class="user-box third-box" style="--delay: .9s" >
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

            <div class="studentList card">
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
        <div class="user-box fourth-box" style="--delay: .10s">

          <p style="font-weight: bold;"> Search Parent</p>
        </div>
        <div class="user-box fifth-box" style="--delay: .10s">

            <div class="form-container">
              <form class="form2"  id="searchParent">
                  <div class="form2-row">
                      <div class="form2-group">
                        <!-- Parent ID search -->
                        <input class="textType" type="text" name="searchParentID" id="searchParentID" placeholder="Parent ID">
                      </div>
                      <div class="form2-group">
                        <!-- Parent Name search -->
                        <input class="textType" type="text" name="searchParentName" id="searchParentName" placeholder="Parent Name">
                      </div>
                  </div>
                  
                  <div class="form2-row">
                      <div class="form2-group">
                        <!-- Parent Mobile Number search -->
                        <input class="textType" type="text" name="searchParentMobileNumber" id="searchParentMobileNumber" placeholder="Mobile Number">
                      </div>
                  </div>
                  
                  <button type="submit" id="searchbtn" class="searchbutton">Search</button>
              </form>
            </div>
              
            
        </div> 
        <div class="user-box sixth-box">
          <div class="modalSections">
                <button class="cards-button button" id="btnParent" style="--delay: .7s">Register Parent</button>
                <button class="cards-button button" id="btnPairing" style="--delay: .7s">Pairing Parent Student</button>
            </div>
        </div>
        <div class="user-box seventh-box">
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