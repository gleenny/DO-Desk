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
            <script type="text/javascript" src="../JAVASCRIPT/darkmode.js" defer></script>
    </head>
<body class="dark-mode">
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
                <h1 style="font-weight: bold; color: var(--title-text);">Settings</h1>
                <br>
                <h7 class="titleSection" style="font-weight: bold; color: var(--title-text);" >Change password</h7>
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
                <h7 class="titleSection" style="font-weight: bold; color: var(--title-text);" >Change Theme</h7>
                <p>Modify the website's theme color by selecting either the Light Theme or the Dark Theme option.</p>
                <button id="theme-switch">
                  <svg fill="#000000" viewBox="0 0 35 35" data-name="Layer 2" id="Layer_2" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M18.44,34.68a18.22,18.22,0,0,1-2.94-.24,18.18,18.18,0,0,1-15-20.86A18.06,18.06,0,0,1,9.59.63,2.42,2.42,0,0,1,12.2.79a2.39,2.39,0,0,1,1,2.41L11.9,3.1l1.23.22A15.66,15.66,0,0,0,23.34,21h0a15.82,15.82,0,0,0,8.47.53A2.44,2.44,0,0,1,34.47,25,18.18,18.18,0,0,1,18.44,34.68ZM10.67,2.89a15.67,15.67,0,0,0-5,22.77A15.66,15.66,0,0,0,32.18,24a18.49,18.49,0,0,1-9.65-.64A18.18,18.18,0,0,1,10.67,2.89Z"></path></g></svg>
                  <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g clip-path="url(#a)" stroke="#000000" stroke-width="1.5" stroke-miterlimit="10"> <path d="M5 12H1M23 12h-4M7.05 7.05 4.222 4.222M19.778 19.778 16.95 16.95M7.05 16.95l-2.828 2.828M19.778 4.222 16.95 7.05" stroke-linecap="round"></path> <path d="M12 16a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" fill="#000000" fill-opacity=".16"></path> <path d="M12 19v4M12 1v4" stroke-linecap="round"></path> </g> <defs> <clipPath id="a"> <path fill="#ffffff" d="M0 0h24v24H0z"></path> </clipPath> </defs> </g></svg>
                </button>
                <br>
                <h7 class="titleSection" style="font-weight: bold; color: var(--title-text);">Batch upload format</h7>
                <p>Please click the button below to download the necessary files for batch upload.</p>
                <div class="formatfiles">
                  <a class="buttonFormats" href="../FormatFiles\pairing student and parent Format.xlsx" download>Pairing student and parent Format</a><br>

                  <a class="buttonFormats" href="../FormatFiles\parents bacth upload Format.xlsx" download>Parent Format</a><br>

                  <a class="buttonFormats"href="../FormatFiles/sanctionFormat.xlsx" download>Sanction Format</a><br>

                  <a class="buttonFormats"href="../FormatFiles\student batch upload Format.xlsx" download>Student Format</a><br>

                  <a class="buttonFormats"href="../FormatFiles\Violation batch upload Format.xlsx" download>Violation Format</a><br>

                </div>  
                <br>
            </div>
        </div>
    </div>
    <div id="snackbar"></div>
    <script src="../JAVASCRIPT/DODeskSettingJS.js"></script>
</body>
</html>