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
        <div class="activity card" style="--delay: .1s">
          <div class="title">Unresolved Violations</div>

          <div class="activity-wrapper">
            <div class="activity-info">
              <div class="subtitle">Minor Violation:</div>
              <div class="subtitle-count" id="minorCount">5</div>
              <div class="subtitle">Major Violation:</div>
              <div class="subtitle-count dist" id="majorCount">45</div>
            </div>
            <div class="activity-chart">
            </div>
          </div>
        </div>

        <!--Second Module-->
        <div class="graph card" style="--delay: .4s">
          <div class="title">Reports </div>

        </div>

        <!--third Module-->
        <!--Calendar-->
        <div class="cards-wrapper" style="--delay: .6s">
          <div class="cards-header">
            <div class="cards-header-date">
              <!--previous month-->
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left">
                <path d="M15 18l-6-6 6-6" />
              </svg>
              <div class="title">January 2020</div>
              <!--next month-->
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                <path d="M9 18l6-6-6-6" />
              </svg>
            </div>
          </div>
          <div class="cards card">
            <div class="cards-head">
              <div class="cards-info">
                <!--Time-->
                <div class="calendar-hour">08.20 <span class="am-pm">pm</span></div>
              </div>
              <!--Settings-->
              <svg viewBox="0 0 512 512" fill="currentColor">
                <path
                  d="M272 512h-32c-26 0-47.2-21.1-47.2-47.1V454c-11-3.5-21.8-8-32.1-13.3l-7.7 7.7a47.1 47.1 0 01-66.7 0l-22.7-22.7a47.1 47.1 0 010-66.7l7.7-7.7c-5.3-10.3-9.8-21-13.3-32.1H47.1c-26 0-47.1-21.1-47.1-47.1v-32.2c0-26 21.1-47.1 47.1-47.1H58c3.5-11 8-21.8 13.3-32.1l-7.7-7.7a47.1 47.1 0 010-66.7l22.7-22.7a47.1 47.1 0 0166.7 0l7.7 7.7c10.3-5.3 21-9.8 32.1-13.3V47.1c0-26 21.1-47.1 47.1-47.1h32.2c26 0 47.1 21.1 47.1 47.1V58c11 3.5 21.8 8 32.1 13.3l7.7-7.7a47.1 47.1 0 0166.7 0l22.7 22.7a47.1 47.1 0 010 66.7l-7.7 7.7c5.3 10.3 9.8 21 13.3 32.1h10.9c26 0 47.1 21.1 47.1 47.1v32.2c0 26-21.1 47.1-47.1 47.1H454c-3.5 11-8 21.8-13.3 32.1l7.7 7.7a47.1 47.1 0 010 66.7l-22.7 22.7a47.1 47.1 0 01-66.7 0l-7.7-7.7c-10.3 5.3-21 9.8-32.1 13.3v10.9c0 26-21.1 47.1-47.1 47.1zM165.8 409.2a176.8 176.8 0 0045.8 19 15 15 0 0111.3 14.5V465c0 9.4 7.7 17.1 17.1 17.1h32.2c9.4 0 17.1-7.7 17.1-17.1v-22.2a15 15 0 0111.3-14.5c16-4.2 31.5-10.6 45.8-19a15 15 0 0118.2 2.3l15.7 15.7a17.1 17.1 0 0024.2 0l22.8-22.8a17.1 17.1 0 000-24.2l-15.7-15.7a15 15 0 01-2.3-18.2 176.8 176.8 0 0019-45.8 15 15 0 0114.5-11.3H465c9.4 0 17.1-7.7 17.1-17.1v-32.2c0-9.4-7.7-17.1-17.1-17.1h-22.2a15 15 0 01-14.5-11.2c-4.2-16.1-10.6-31.6-19-45.9a15 15 0 012.3-18.2l15.7-15.7a17.1 17.1 0 000-24.2l-22.8-22.8a17.1 17.1 0 00-24.2 0l-15.7 15.7a15 15 0 01-18.2 2.3 176.8 176.8 0 00-45.8-19 15 15 0 01-11.3-14.5V47c0-9.4-7.7-17.1-17.1-17.1h-32.2c-9.4 0-17.1 7.7-17.1 17.1v22.2a15 15 0 01-11.3 14.5c-16 4.2-31.5 10.6-45.8 19a15 15 0 01-18.2-2.3l-15.7-15.7a17.1 17.1 0 00-24.2 0l-22.8 22.8a17.1 17.1 0 000 24.2l15.7 15.7a15 15 0 012.3 18.2 176.8 176.8 0 00-19 45.8 15 15 0 01-14.5 11.3H47c-9.4 0-17.1 7.7-17.1 17.1v32.2c0 9.4 7.7 17.1 17.1 17.1h22.2a15 15 0 0114.5 11.3c4.2 16 10.6 31.5 19 45.8a15 15 0 01-2.3 18.2l-15.7 15.7a17.1 17.1 0 000 24.2l22.8 22.8a17.1 17.1 0 0024.2 0l15.7-15.7a15 15 0 0118.2-2.3z">
                </path>
                <path
                  d="M256 367.4c-61.4 0-111.4-50-111.4-111.4s50-111.4 111.4-111.4 111.4 50 111.4 111.4-50 111.4-111.4 111.4zm0-192.8a81.5 81.5 0 000 162.8 81.5 81.5 0 000-162.8z">
                </path>
              </svg>
            </div>
            <div class="items days">

              <div class="item">Mon</div>
              <div class="item">Tue</div>
              <div class="item">Wed</div>
              <div class="item">Thu</div>
              <div class="item">Fri</div>
              <div class="item">Sat</div>
              <div class="item">Sun</div>

            </div>
            <div class="items numbers">

              <div class="item">1</div>
              <div class="item">2</div>
              <div class="item">3</div>
              <div class="item">4</div>
              <div class="item">5</div>
              <div class="item">6</div>
              <div class="item">7</div>
              <div class="item">8</div>
              <div class="item">9</div>
              <div class="item">10</div>
              <div class="item">11</div>
              <div class="item">12</div>
              <div class="item">13</div>
              <div class="item">14</div>
              <div class="item">15</div>
              <div class="item">16</div>

              <div class="item is-active">17</div>

              <div class="item">18</div>
              <div class="item">19</div>
              <div class="item">20</div>
              <div class="item">21</div>
              <div class="item">22</div>
              <div class="item">23</div>
              <div class="item">24</div>
              <div class="item">25</div>
              <div class="item">26</div>
              <div class="item">27</div>
              <div class="item">28</div>
              <div class="item">29</div>
              <div class="item">30</div>
              <div class="item">31</div>
              <div class="item disable">1</div>
              <div class="item disable">2</div>
              <div class="item disable">3</div>

            </div>
          </div>
        </div>

          <!--Profile Module-->
          <div class="account-wrapper" style="--delay: .8s">
            <div class="account-profile">
              
              <img id="profilePic" >
              <div class="blob-wrap">

                <div class="blob"></div>
                <div class="blob"></div>
                <div class="blob"></div>

              </div>
              <div class="account-name" id="accountName" >
                <?php
                
                echo $_SESSION['firstName']. " ". $_SESSION['lastName'];
                
                ?>
              </div>
              <div class="account-title" id="accountRole">
                <?php
                
                echo $_SESSION['role'];
                
                ?>
              </div>
            </div>
          <div class="account card">

          </div>
        </div>
      </div>

      <!--2nd Card-->
      <div class="user-box second-box">

        <!--List Module-->
        <div class="cards-wrapper" style="--delay: 1s">
          <div class="cards-header">
            <div class="cards-view">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-calendar">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
              </svg>

              <span class="today"> Recent List </span>
            </div>
          </div>
          <div class="cards card">
            <table class="table">
              <thead>
                <tr>
                  <th>Record By</th>
                  <th>Student number</th>
                  <th>Student Name</th>
                  <th>Course</th>
                  <th>Section</th>
                  <th>Type Of Violation</th>
                  <th>Case</th>
                  <th>Status</th>
                </tr>
              </thead>

              <tbody id="reportListRows">
              </tbody>
            </table>
          </div>
        </div>

        <!--Incoming Events Module-->

        <div class="card calendarEvent" style="--delay: 1.2s">
          <div class=" -header">
            <div class="head">Incoming Events</div>
            <div class="head viewBtn">View All</div>
            </div>
          </div>
       </div>

    </div>

    <!--Scroll bar properties-->
    <script src="../JAVASCRIPT/DODeskDashboardJS.js"></script>
</body>

</html>