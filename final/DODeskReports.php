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
        <link rel="stylesheet" href="../CSS/DODesk-ReportStyle.css">
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
      
      <!--4TH Flow-->
      <div class="user-box first-box" style="--delay: .1s">
        <h2 style="font-weight: bold;">Trancripts</h2>
        <br>
      </div>
      <div class="user-box first-box" style="--delay: .2s">

      <p>To view evidence records associated with a violation, please enter the Violation ID in the search field.</p>
    </div>
      <div class="user-box first-box" style="--delay: .3s">
      <input class="textType" type="text" id="violationID" placeholder="violation ID">
      <button class="searchbutton" id="searchBTN">search files</button>
      </div>

    <!--5TH Flow-->
    <div class="user-box third-box" style="--delay: .1s">
      <!--List Module-->
      <div class="cards-wrapper" style="--delay: 1s">
        <div class="cards-header">
        <div class="cards-view">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
          <path d="M16 2v4M8 2v4M3 10h18" />
          </svg>
          
          <span class="today">Transcript files</span> </div>
        
        </div>
        <div class="cards card">
        <table class="table">
          <thead>
          <tr>
            <th>Transcript ID</th>
            <th>Violation Type</th>
            <th>Violatin Case</th>
            <th>Status</th>
            <th>Date</th>
            <th>File</th>
          </tr>
          </thead>
          <tbody id="transcriptFiles">
          </tbody>
        </table>
        </div>
        </div>
        <div id="snackbar"></div>
      </div>  
      <div class="user-box sixth-box" style="--delay: .9s">
        <!-- The Modal Register Violation -->
        <div id="modalSubmit" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <!--Adding Violations-->
            <div class="form-container">
              <div class="formModal">
                <div class="formModal-row">
                  <div class="formModal-group">
                    <span id="studentInfo"></span>
                  </div>
                </div>
              </div>
              <div class="formModal">
                <div class="formModal-row">
                  <div class="formModal-group">
                    <span id="violationIDInfo"></span>
                  </div>
                </div>
              </div>
              <div class="formModal">
                <div class="formModal-row">
                  <div class="formModal-group">
                    <textarea class="textbox" readonly id="myTextarea" placeholder="Displaying trancript file"></textarea><br>  
                  </div>
                </div>
              </div>
              <div class="formModal">
                <div class="formModal-row">
                  <div class="formModal-group">
                    <audio controls id="audio"  class="audioInput" >
                    <source id="audioPlayer" src="">
                  </div>
                </div>
              </div>
            </div>
            

          </div>
      <script src="../JAVASCRIPT/DODeskReportsJS.js"></script>
</body>
</html>