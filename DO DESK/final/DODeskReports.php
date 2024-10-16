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
      <!--1st Flow-->
      <div class="user-box first-box" style="--delay: .1s">
        <span>Reports</span>
        <svg id='Report_File_24' width='30' height='30' viewBox='5 0 18 23' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
          <g transform="matrix(0.77 0 0 0.77 12 12)" >
          <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: #9b9ca7; fill-rule: nonzero; opacity: 1;" transform=" translate(-16, -16)" d="M 6 3 L 6 29 L 14 29 L 14 27 L 8 27 L 8 5 L 18 5 L 18 11 L 24 11 L 24 17 L 26 17 L 26 9.5859375 L 19.414062 3 L 6 3 z M 20 6.4140625 L 22.585938 9 L 20 9 L 20 6.4140625 z M 24 19 L 24 29 L 26 29 L 26 19 L 24 19 z M 20 22 L 20 29 L 22 29 L 22 22 L 20 22 z M 16 25 L 16 29 L 18 29 L 18 25 L 16 25 z" stroke-linecap="round" />
          </g>
          </svg>
      </div>

      <!--2nd Flow-->
      <div class="user-box second-box" style="--delay: .1s">
          <span>QUICK ACCESS</span>

      </div>    
      <!--3rd Flow-->
      <div class="user-box third-box" style="--delay: .2s">
        
        <div class="recentCase card" style="--delay: .4s">
          <span> CASES </span>
          <div class="title">Recent Cases</div>
        </div>

        <div class="card createFolder" style="--delay: .8s">
          <a class="createText" href="http://127.0.0.1:5500/DO%20DESK/Final%20HTML/DODesk-OnTranscribe.html">New Case</a>
        </div>
      </div>    

       <!--4TH Flow-->

      <div class="user-box fourth-box" style="--delay: .9s">
        <span>CASES</span>
    </div>  

    <!--5TH Flow-->
    <div class="user-box fifth-box" style="--delay: .1s">
      <!--List Module-->
      <div class="cards-wrapper" style="--delay: 1s">
        <div class="cards-header">
        <div class="cards-view">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
          <path d="M16 2v4M8 2v4M3 10h18" />
          </svg>
          
          <span class="today"> Case List</span>
        </div>
        
        <div class="cards-button button">
          <span class="spaceleft">Search Case</span>
          <svg id='Search_24' width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='30' height='30' stroke='3' fill='#000000' opacity='0'/>
            <g transform="matrix(0.46 0 0 0.46 12 12)" >
            <path style=" margin-left: 5px; stroke: none; stroke-width: 2; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill:#9b9ca7; fill-rule: nonzero; opacity: 1;" transform=" translate(-25.45, -24.95)" d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z" stroke-linecap="round" />
            </g>
            </svg>
        </div>
        </div>
        <div class="cards card">
        <table class="table">
          <thead>
          <tr>
            <th>Record By</th>
            <th>Reported by</th>
            <th>Course</th>
            <th>Year</th>
            <th>Section</th>
            <th>Date</th>
            <th>Time</th>
            <th></th>
          </tr>
          </thead>
          
          <tbody>
          <!--First Line #9b9ca7; -->
          <tr class="list">
            <td>Mr.Gonzales</td>
            <td>Garejo, Gleenn Michael</td>
            <td>BSIT</td>
            <td>4TH Year</td>
            <td>A705</td>
            <td>January 24 2024</td>
            <td>3:32pm</td>
            <td>
              <svg id='Setting_Menu_Horizontal_24' width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
                <g transform="matrix(1.43 0 0 1.43 12 12)" >
                <g style="" >
                <g transform="matrix(1 0 0 1 -4.7 0)" >
                <path style="stroke: #9b9ca7; stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" transform=" translate(-2.3, -7)" d="M 2.30493 8.5 C 3.26493 8.5 3.80493 7.96 3.80493 7 C 3.80493 6.04 3.26493 5.5 2.30493 5.5 C 1.34493 5.5 0.804932 6.04 0.804932 7 C 0.804932 7.96 1.34493 8.5 2.30493 8.5 Z" stroke-linecap="round" />
                </g>
                <g transform="matrix(1 0 0 1 0.02 0)" >
                <path style="stroke: #9b9ca7; stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" transform=" translate(-7.02, -7)" d="M 7.02368 8.5 C 7.98368 8.5 8.52368 7.96 8.52368 7 C 8.52368 6.04 7.98368 5.5 7.02368 5.5 C 6.06368 5.5 5.52368 6.04 5.52368 7 C 5.52368 7.96 6.06368 8.5 7.02368 8.5 Z" stroke-linecap="round" />
                </g>
                <g transform="matrix(1 0 0 1 4.74 0)" >
                <path style="stroke: #9b9ca7;stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" transform=" translate(-11.74, -7)" d="M 11.7424 8.5 C 12.7024 8.5 13.2424 7.96 13.2424 7 C 13.2424 6.04 12.7024 5.5 11.7424 5.5 C 10.7824 5.5 10.2424 6.04 10.2424 7 C 10.2424 7.96 10.7824 8.5 11.7424 8.5 Z" stroke-linecap="round" />
                </g>
                </g>
                </g>
                </svg>
            </td>
          </tr>
          <!--Second Line-->
          <tr class="list">
            <td>Mr.Gonzales</td>
            <td>Garejo, Gleenn Michael</td>
            <td>BSIT</td>
            <td>4TH Year</td>
            <td>A705</td>
            <td>January 24 2024</td>
            <td>3:32pm</td>
            <td>
              <svg id='Setting_Menu_Horizontal_24' width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
                <g transform="matrix(1.43 0 0 1.43 12 12)" >
                <g style="" >
                <g transform="matrix(1 0 0 1 -4.7 0)" >
                <path style="stroke: #9b9ca7; stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" transform=" translate(-2.3, -7)" d="M 2.30493 8.5 C 3.26493 8.5 3.80493 7.96 3.80493 7 C 3.80493 6.04 3.26493 5.5 2.30493 5.5 C 1.34493 5.5 0.804932 6.04 0.804932 7 C 0.804932 7.96 1.34493 8.5 2.30493 8.5 Z" stroke-linecap="round" />
                </g>
                <g transform="matrix(1 0 0 1 0.02 0)" >
                <path style="stroke: #9b9ca7; stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" transform=" translate(-7.02, -7)" d="M 7.02368 8.5 C 7.98368 8.5 8.52368 7.96 8.52368 7 C 8.52368 6.04 7.98368 5.5 7.02368 5.5 C 6.06368 5.5 5.52368 6.04 5.52368 7 C 5.52368 7.96 6.06368 8.5 7.02368 8.5 Z" stroke-linecap="round" />
                </g>
                <g transform="matrix(1 0 0 1 4.74 0)" >
                <path style="stroke: #9b9ca7;stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" transform=" translate(-11.74, -7)" d="M 11.7424 8.5 C 12.7024 8.5 13.2424 7.96 13.2424 7 C 13.2424 6.04 12.7024 5.5 11.7424 5.5 C 10.7824 5.5 10.2424 6.04 10.2424 7 C 10.2424 7.96 10.7824 8.5 11.7424 8.5 Z" stroke-linecap="round" />
                </g>
                </g>
                </g>
                </svg>
            </td>
          </tr>
          <!--fourth Line-->
          <tr class="list">
            <td>Mr.Gonzales</td>
            <td>Garejo, Gleenn Michael</td>
            <td>BSIT</td>
            <td>4TH Year</td>
            <td>A705</td>
            <td>January 24 2024</td>
            <td>3:32pm</td>
            <td>
              <svg id='Setting_Menu_Horizontal_24' width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
                <g transform="matrix(1.43 0 0 1.43 12 12)" >
                <g style="" >
                <g transform="matrix(1 0 0 1 -4.7 0)" >
                <path style="stroke: #9b9ca7; stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" transform=" translate(-2.3, -7)" d="M 2.30493 8.5 C 3.26493 8.5 3.80493 7.96 3.80493 7 C 3.80493 6.04 3.26493 5.5 2.30493 5.5 C 1.34493 5.5 0.804932 6.04 0.804932 7 C 0.804932 7.96 1.34493 8.5 2.30493 8.5 Z" stroke-linecap="round" />
                </g>
                <g transform="matrix(1 0 0 1 0.02 0)" >
                <path style="stroke: #9b9ca7; stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" transform=" translate(-7.02, -7)" d="M 7.02368 8.5 C 7.98368 8.5 8.52368 7.96 8.52368 7 C 8.52368 6.04 7.98368 5.5 7.02368 5.5 C 6.06368 5.5 5.52368 6.04 5.52368 7 C 5.52368 7.96 6.06368 8.5 7.02368 8.5 Z" stroke-linecap="round" />
                </g>
                <g transform="matrix(1 0 0 1 4.74 0)" >
                <path style="stroke: #9b9ca7;stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" transform=" translate(-11.74, -7)" d="M 11.7424 8.5 C 12.7024 8.5 13.2424 7.96 13.2424 7 C 13.2424 6.04 12.7024 5.5 11.7424 5.5 C 10.7824 5.5 10.2424 6.04 10.2424 7 C 10.2424 7.96 10.7824 8.5 11.7424 8.5 Z" stroke-linecap="round" />
                </g>
                </g>
                </g>
                </svg>
            </td>
          </tr>
          
          </tbody>
        </table>
        </div>
      </div>

  </div>  
      
        <!--Scroll bar properties-->
        <script>
          document.addEventListener("DOMContentLoaded", function() {
              document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
              document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
          });
      </script>
</body>
</html>