<?php if(!isset($_SESSION)){
  session_start();
} // Start the session ?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
            <link rel="stylesheet" href="../CSS/aDODesk-ReportAnalysis.css">
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
<body >
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
      <div class="user-box first-box" style="--delay: .4s">
        <p style="font-weight: bold; color: var(--title-text); font-size: 25px;">Reports analysis</p>
      </div>

      <div class="user-box third-box" style="--delay: 1s">
        <p style="font-weight: bold; color: var(--title-text);"> Violation Reports</p>       
      </div>

      <div class="user-box second-box">            
          <div class="graph card" style="--delay: 1s">
            <div class="title">Violation Bar Graph</div>
            <canvas id="barchartViolation" width="300" height="100"></canvas>
          </div>
        <div class="activity card" style="--delay: 1s">
            <div class="title">Violations Overall</div>

            <div class="activity-wrapper">
              <div class="activity-info">
                
              </div>
              <div class="activity-chart">
                <canvas id="doughnutViolationOverall" width="250" height="250"></canvas>
              </div>
            </div>
          </div>
      </div>

      <div class="user-box third-box" style="--delay: 1s">
        <p style="font-weight: bold; color: var(--title-text);"> Sanction Reports</p>       
      </div>

      <div class="user-box third-box">
        <div class="graph card" style="--delay: 1s">
          <div class="title">Sanction Bar Graph</div>
          <canvas id="barchartSanction" width="300" height="100"></canvas>
        </div>
       
        <div class="activity card" style="--delay: 1s">
        <div class="title">Sanction Overall</div>

          <div class="activity-wrapper">
            <div class="activity-info">
              
            </div>
            <div class="activity-chart">
              <canvas id="doughnutSanctionOverall" width="250" height="250"></canvas>
            </div>
          </div>
        </div>
        

      </div>



    <div id="snackbar"></div>
    <script src="../JAVASCRIPT/DODeskSettingJS.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script src="../Charts/chart1.js"></script>
    <script src="../Charts/chartOverallViolation.js"></script>
</body>
</html>