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
        <link rel="stylesheet" href="../CSS/DODeskAdministrator.css">
        <!--Script-->
        <link rel="stylesheet" href="styles.css">
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
      <script type="text/javascript" src="../JAVASCRIPT/darkmode.js" defer></script>
</head>
<body>
  <!--Checks if dumaan sa login-->
  <?php if(!isset($_SESSION['userID']) || $_SESSION['userID'] === ''){ ?>
    <script>window.location.href = "DODeskLogin.php";</script>
  <?php } ?>
    <!--Left side nav-->
    <div class="wrapper">
      <?php
        require_once 'userHeader.php';
      ?>
      <!--first box-->
      <div class="user-box zero-box" style="--delay: .6s">
        <p style="font-weight: bold; color: var(--title-text);">Users Table</p>
      </div>
      <div class="user-box first-box" style="--delay: .6s">
          <!--searching violations-->
          <div class="form-container">
            <p>Search User</p>
            <form class="form1" id="searchForm">
              <div class="form1-row"><!--first row-->
                <div class="form1-group"><!--column 1-->
                  <input class="textType" type="text" name="searchNumber" id="searchUserID" placeholder="User ID">
                </div>
                <div class="form1-group"><!--column 2-->
                  <input class="textType" type="text" name="searchName" id="searchName" placeholder="Name">
                </div>
              </div>
              <div class="form1-row"><!--first row-->
                <div class="form1-group"><!--column 1-->
                  <select class="select" name="status" id="searchStatus" value="">
                    <option value="">Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>
              
              <button type="submit" id="searchbtn" class="searchbutton">Search</button>
            </form>
          </div>
          
      </div>  
      
      <!--Second box-->
      <div class="user-box second-box" style="--delay: .6s">
        <!-- Trigger/Open The Modal -->
         <div class="buttonSection">
          <button class="cards-button button" id="btnRegister">Register Administrator</button>
          <button class="cards-button button" id="btnUpdateStatus">Update Status</button>
          <button class="cards-button button" id="btnChangePassword">Change Passsword</button>
        <!--PAKILIPAT TO-->
          

         </div>  <br>     
        <!-- The Modal Register Violation -->
        <div id="modalRegister" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
        <span class="close">&times;</span>
        <!--Title-->
        <div class="title">Register User</div>
        <!--Adding Violations-->
        <div class="form-container">
          <form class="formModal" action="../JAVASCRIPT/DODeskAdmin.js" enctype="multipart/form-data" method="POST" id="myform">
              <div class="formModal-row">
                <div class="formModal-group">
                  <input type="text" placeholder="First Name" id="firstName">
                </div>
              </div>
              <div class="formModal-row">
                <div class="formModal-group">
                  <input type="text" placeholder="Middle Name" id="middleName">                  
                </div>
              </div>
              <div class="formModal-row">
                <div class="formModal-group">
                  <input type="text" placeholder="Last Name" id="lastName">
                </div>
              </div>
              <div class="formModal-row">
                <div class="formModal-group">
                <input type="text" placeholder="Username" id="username">

                </div>
                
              </div>
              <div class="formModal-row">
                <div class="formModal-group">
                  <input type="text" placeholder="Password" id="password">
                </div>
              </div>
              <div class="formModal-row">
                <div class="formModal-group">
                  <select  name="status" id="role" value="">
                    <option value="Disciplinary Officer">Disciplinary Officer</option>
                    <option value="Admin">Admin</option>
                  </select>
                </div>  
              </div>
              <input class="modalBtn" type="submit" value="Resgister User" name="submit" > 
            </form>
        </div>
         
        </div>
      </div>

      <!--updating violation status-->
      <!-- Trigger/Open The Modal -->

      <!-- The Modal -->
      <div id="modalUpdateStatus" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <div class="title">Update Status</div>

          <div class="form-container">
            <form class="formModal" action="../JAVASCRIPT/DODeskAdmin.js" enctype="multipart/form-data" method="POST" id="updateStatusForm">
              <div class="formModal-row">
                <div class="formModal-group">
                  <select name="adminID" id="adminID" value=" ">
                  </select>
                </div>
              </div>
              <div class="formModal-row">
                <div class="formModal-group">
                  <select name="adminStatus" id="adminStatus" value=" ">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
              </div>
              <div class="formModal-row">
                <div class="formModal-group">
                <input class="modalBtn" type="submit" value="Update Status" name="submit">
                </div>
              </div>
                            
            </form>
          </div>
          
          </div>
        </div>

      <!--change password-->
      <!-- Trigger/Open The Modal -->
            
      <!-- The Modal -->
      <div id="modalChangePassword" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <div class="title">Change Password</div>
            <div class="form-container">
              <form class="formModal" action="../JAVASCRIPT/DODeskAdmin.js" enctype="multipart/form-data" method="POST" id="changePasswordForm">
                <div class="formModal-row">
                  <div class="formModal-group">
                    <select name="userIDPassword" id="userIDPassword" value=" ">
                    </select>
                  </div>
                </div>
                <div class="formModal-row">
                  <div class="formModal-group">
                  <input type="text" placeholder="Password" id="changePassword">
                  </div>
                </div>
                <div class="formModal-row">
                  <div class="formModal-group">
                  <input class="modalBtn" type="submit" value="Change Password" name="submit">
                  </div>
                </div>
              </form>
            </div>
          
          </div>
        </div>

        <!--change username-->
      <!-- Trigger/Open The Modal -->
      <!-- The Modal -->
      <div id="modalChangeUsername" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <form action="../JAVASCRIPT/DODeskAdmin.js" enctype="multipart/form-data" method="POST" id="changeUsernameForm">
            <div class="title">Change username</div>
            <input type="text" placeholder="User ID" id="userIDUsername">
            <input type="text" placeholder="Username" id="changeUsername">
            <input class="modalBtn" type="submit" value="Change Username" name="submit">
          </form>
          </div>
        </div>

      </div>

      <div class="user-box third-box">
        <!--3:First module-->
        <!--List Module-->
        <div class="cards-wrapper" style="--delay: .8s">
          <div class="cards-header">
            
          <div class="cards-view">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
            <rect x="3" y="4" width="16" height="16" rx="2" ry="2" />
            <path d="M16 2v4M8 2v4M3 10h18" />
            </svg>
            
            <span class="today">Users</span>
          </div>
          </div>
          <div class="cards card">
          <table class="table">
            <thead>
            <tr>
              <th>User ID</th>
              <th>Name</th>
              <th>Username</th>
              <th>Role</th>
              <th>Status</th>
            </tr>
            </thead>

            <tbody id="userListRows">
            </tbody>
          </table>
          </div>
        </div>
      </div>
      <br>
      <div class="user-box titlefourthhalf-box" style="--delay: .6s">
        <p style="font-weight: bold; color: var(--title-text);">Violations Setting</p>

      </div>

      <div class="user-box fourthhalf-box" style="--delay: .6s">
        
        <div class="violation-form">
          <p>Register a new violation here. Please specify the type of violation: minor or major.</p>
          <input class="newViolation" type="text" name="newViolation" id="newViolation" placeholder="New Violation"> 
          <select class="violationType" name="status" id="newViolationType" value="">
            <option value="">Violation Type</option>
            <option value="Minor">Minor</option>
            <option value="Major">Major</option>
          </select>
          <button class="cards-button button" id="addNewViolation">Add new violation</button>
        </div>
      </div>
    <br>
      <div class="user-box zero-box" style="--delay: .6s">
        <p style="font-weight: bold;   color: var(--title-text); ">Audit Table</p>
      </div>
      
      <!--4th Card-->
      <div class="user-box fourth-box" style="--delay: .9s">
          <!--searching violations-->
          <div class="form-container">
            <form class="form2" id="searchAuditForm">
              <div class="form2-row"><!--first row-->
                <div class="form2-group"><!--column 1-->
                  <input class="textType" type="text" name="searchAuditLOGID" id="searchAuditLOGID" placeholder="Log ID">
                </div>
                <div class="form2-group"><!--column 2-->
                <input class="textType" type="text" name="searchAuditName" id="searchAuditName" placeholder="Name">
                </div>
              </div>
              <div class="form2-row"><!--second row-->
                <div class="form2-group"><!--column 1-->
                  <input class="textType" type="date" name="searchAuditDate" id="searchAuditDate" placeholder="Transaction Date-Time">
                  <input class="textType" type="date" name="searchAuditUntilDate" id="searchAuditUntilDate" placeholder="Transaction Date-Time">
                </div>
              </div>
              <div class="form2-row"><!--second row-->
                <div class="form2-group"><!--column 1-->
                  <input class="textType" type="text" name="searchAuditProcess" id="searchAuditProcess" placeholder="Process">
                </div>
                <div class="form2-group"><!--column 2-->
                  <input class="textType" type="text" name="searchAuditNote" id="searchAuditNote" placeholder="Note">
                </div>
              </div>
              <button type="submit" id="searchbtn" class="searchbutton">Search</button>
            </form>
          </div>
      </div>  
            <!--5th Card-->

      <div class="user-box fifth-box">

        <!--List Module-->
        <div class="auditTrail cards-wrapper" style="--delay: 1s">
          <div class="cards-header">
            <div class="cards-view">
                <svg id='Summary_List_24' `width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' fill="currentColor" ><rect width='24' height='24' stroke='none' fill='#9b9ca7' opacity='0'/>
                <g transform="matrix(1 0 0 1 12 12)" >
                <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; rgba(155,156,167,255); fill-rule: nonzero; opacity: 1;" transform=" translate(-12, -12)" d="M 20 3 L 4 3 C 2.897 3 2 3.897 2 5 L 2 19 C 2 20.103 2.8970000000000002 21 4 21 L 20 21 C 21.103 21 22 20.103 22 19 L 22 5 C 22 3.897 21.103 3 20 3 z M 11 17 L 5 17 L 5 15 L 11 15 L 11 17 z M 11 13 L 5 13 L 5 11 L 11 11 L 11 13 z M 11 9 L 5 9 L 5 7 L 11 7 L 11 9 z M 15 17 L 13 17 L 13 7 L 15 7 L 15 17 z M 19 17 L 17 17 L 17 15 L 19 15 L 19 17 z M 19 13 L 17 13 L 17 11 L 19 11 L 19 13 z M 19 9 L 17 9 L 17 7 L 19 7 L 19 9 z" stroke-linecap="round" />
                </g>
                </svg>
              <span class="today" > Audit Trail </span>
            </div>
          </div>
          <div class="cards card">
            <table class="table">
              <thead>
                <tr>
                  <th class="th1">Log ID</th>
                  <th class="th2">Name</th>
                  <th class="th3">Transaction Date-Time</th>
                  <th class="th4">Process</th>
                  <th class="th5">Note</th>
                </tr>
              </thead>

              <tbody id="AuditListRows">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Snackbar element -->
    <div id="snackbar"></div>
        <script src="../JAVASCRIPT/DODeskAdmin.js"></script>
</body>
</html>