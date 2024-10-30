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
  <link rel="stylesheet" href="../CSS/DODesk-AuditStyle.css">
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
  <div class="wrapper">
      <?php
      require_once 'userHeader.php';
      ?>
      <!---first module-->
      <div class="user-box first-box">
       
      </div>

      <!--2nd Card-->
      <div class="user-box second-box">

        <!--List Module-->
        <div class="cards-wrapper" style="--delay: 1s">
          <div class="cards-header">
            <div class="cards-view">
                <svg id='Summary_List_24' width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' fill="currentColor" ><rect width='24' height='24' stroke='none' fill='#9b9ca7' opacity='0'/>
                <g transform="matrix(1 0 0 1 12 12)" >
                <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; rgba(155,156,167,255); fill-rule: nonzero; opacity: 1;" transform=" translate(-12, -12)" d="M 20 3 L 4 3 C 2.897 3 2 3.897 2 5 L 2 19 C 2 20.103 2.8970000000000002 21 4 21 L 20 21 C 21.103 21 22 20.103 22 19 L 22 5 C 22 3.897 21.103 3 20 3 z M 11 17 L 5 17 L 5 15 L 11 15 L 11 17 z M 11 13 L 5 13 L 5 11 L 11 11 L 11 13 z M 11 9 L 5 9 L 5 7 L 11 7 L 11 9 z M 15 17 L 13 17 L 13 7 L 15 7 L 15 17 z M 19 17 L 17 17 L 17 15 L 19 15 L 19 17 z M 19 13 L 17 13 L 17 11 L 19 11 L 19 13 z M 19 9 L 17 9 L 17 7 L 19 7 L 19 9 z" stroke-linecap="round" />
                </g>
                </svg>
              <span class="today"> Audit Trail </span>
            </div>
          </div>
          <div class="cards card">
            <table class="table">
              <thead>
                <tr>
                  <th>Login ID</th>
                  <th>User ID</th>
                  <th>Transaction Date </th>
                  <th>Time</th>
                  <th>Process</th>
                  <th>Note</th>
                </tr>
              </thead>

              <tbody id="AuditListRows">
              </tbody>
            </table>
          </div>
        </div>



    </div>

    <!--Scroll bar properties-->
    <script src="../JAVASCRIPT/DODeskDashboardJS.js"></script>
</body>

</html>