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
            <link rel="stylesheet" href="../CSS/DODesk-SettingsStyle.css">
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
        <div class="user-box first-box">
            <div class="searchs card" style="--delay: .2s">
                <h1 style="font-weight: bold; color: #ccc8fc;">Settings</h1>
                <br>
                <h7 class="titleSection" style="font-weight: bold;" >Change password</h7>
                <p>Kindly enter your current password, followed by your new password.</p>
                <br>
                <form class="form-container" id="changePassword" method="POST">
                    <div class="form-columns">
                        <div class="column">
                        <input class="textType" type="text" placeholder="Old password" id="oldPass">
                    <input class="textType" type="text" placeholder="New password" id="newPass">
                    <input class="search" type="submit" value="Change Password" name="submit">
                        </div>
                    </div>
                </form>
                <br>
                <h7 class="titleSection" style="font-weight: bold; ">Batch upload format</h7>
                <p>Please click the button below to download the necessary files for batch upload.</p>
                <br>
                <div class="formatfiles">
                  <a class="buttonFormats" href="../FormatFiles\pairing student and parent Format.xlsx" download>Pairing student and parent Format</a><br>

                  <a class="buttonFormats" href="../FormatFiles\parents bacth upload Format.xlsx" download>Parent Format</a><br>

                  <a class="buttonFormats"href="../FormatFiles/sanctionFormat.xlsx" download>Sanction Format</a><br>

                  <a class="buttonFormats"href="../FormatFiles\student batch upload Format.xlsx" download>Student Format</a><br>

                  <a class="buttonFormats"href="../FormatFiles\Violation batch upload Format.xlsx" download>Violation Format</a><br>

                </div>    
        </div>
        
    </div>
    <div id="snackbar"></div>
    <script src="../JAVASCRIPT/DODeskSettingJS.js"></script>
</body>
</html>