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
  <link rel="stylesheet" href="../CSS/DODesk-DashboardStyle.css">
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
  <div class="wrapper">
      <?php
      require_once 'userHeader.php';
      ?>
      <div class="user-box second-box">
          <p style="--delay: .5s; color: var(--title-text); font-weight: bold; font-size: 2rem;">Welcome back! Sir <?php echo $_SESSION['firstName']. " ". $_SESSION['lastName']; ?> </p>
      </div>

      <div class="user-box second-box">            
          <div class="graph card" style="--delay: 1s">
            <div class="title">Violation Bar Graph</div>
            <canvas id="barchartViolation" width="300" height="100"></canvas>
          </div>
        <div class="activity card" style="--delay: 1s">
            <div class="title">Unresolved Violations</div>

            <div class="activity-wrapper">
              <div class="activity-info">
                <div class="subtitle">Minor Violation:</div>
                <div class="subtitle-count" id="minorCount">5</div>
                <div class="subtitle">Major Violation:</div>
                <div class="subtitle-count dist" id="majorCount">45</div>
              </div>
              <div class="activity-chart">
                <canvas id="doughnutViolation" width="250" height="250"></canvas>
              </div>
            </div>
          </div>
      </div>

      <div class="user-box third-box">
        <div class="activity card" style="--delay: 1s">

          <div class="activity-wrapper">

            <div class="activity-info">
            <div class="title">Sanction Status</div>
              <div class="subtitle">Resolved Status:</div>
              <div class="subtitle-count" id="minorCount">5</div>
              <div class="subtitle">Unresolved Status:</div>
              <div class="subtitle-count dist" id="majorCount">45</div>
            </div>
            <div class="activity-chart">
              <canvas id="doughnutSanction" width="200" height="200"></canvas>
            </div>
          </div>
        </div>
        
        <div class="graph card" style="--delay: 1s">
          <div class="title">Sanction Bar Graph</div>
          <canvas id="barchartSanction" width="300" height="100"></canvas>
        </div>
       
      </div>


      <!--2nd Card-->
      <div class="user-box fourt-box">

        <!--List Module-->
        <div class="list cards-wrapper" style="--delay: 1s">
          <div class="cards-header">
            <div class="cards-view">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-calendar">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
              </svg>

              <span class="TableTitle"> Recent List </span>
            </div>
          </div>
          <div class="recentList card">
            <table>
            <thead>
              <tr>
                <th scope="col">Record By</th>
                <th scope="col">Student number</th>
                <th scope="col">Student Name</th>
                <th scope="col">Course</th>
                <th scope="col">Type Of Violation</th>
                <th scope="col">Case</th>
                <th scope="col">Status</th>
              </tr>
            </thead>

              <tbody id="reportListRows">
              </tbody>
            </table>
          </div>
        </div>
    </div>

    <script src="../JAVASCRIPT/DODeskDashboardJS.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script src="../Charts/chart1.js"></script>
    <script src="../Charts/chart2.js"></script>

</body>

</html>