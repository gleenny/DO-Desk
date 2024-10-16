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
        <link rel="stylesheet" href="../CSS/DODesk-OnTranscribeStyle.css">
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
            <!--FIrst Column-->
            <div class="user-box first-box">
              <div class="notes card" style="--delay: .1s">
                <p>Recording Case</p>
                <br>
                
                <div class="textarea-container">
                  <textarea readonly id="myTextarea" placeholder="Upload your audio file"></textarea>
                  <div class="inputs-container">
                    <!-- Inputs -->
                    
                  </div>
                </div>
                <button id="record">record</button>
                <button id="stop">stop</button>
                <br>
                <br>
                <form action="../JAVASCRIPT/upload.js" method="post" enctype="multipart/form-data" id="myform">
                  <input type="file" id="myFile" name="filename">
                  <input type="submit" value="Upload File" name="submit">
                </form>
                <audio controls id="audio">
                  <source id="audioPlayer" src="">
                </audio>
                <p>Click on the "Choose File" button to upload a file:</p>
                <p>File Supported: mp3, mp4, mpeg, mpga, m4a, wav, and webm. File size should not exceed 25mb</p>
              </div> 
            </div>
          </div>
        <!--Scroll bar properties-->
      <script src="../JAVASCRIPT/upload.js"></script>
</body>
</html>
