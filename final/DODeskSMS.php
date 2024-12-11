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
  <link rel="stylesheet" href="../CSS/DODESK-SMSStyle.css">
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
  <div class="wrapper">
    <?php
    require_once 'userHeader.php';
    ?>
      <div class="user-box first-box" style="--delay: .1s">

        <div class="SMSPage card" style="--delay: .1s">
          <div class="boxcard">
            <button class="svg-button" id="historyBtn">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="currentColor">
                <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 15h-2v-6h3v2h-1zM11 4v2H6v5H4V4z"/>
              </svg>
            </button>
            <div class="boxcard-content">
              <div class="searchStudent">
                  <div class="title">Contact Personnel</div>
                    <!--Search Student-->
                      <label class="titlelabel">Search Student</label>
                      <p class="notice"> Search the student and you can see the parent name and their phone number </p>
                      <form action="../JAVASCRIPT/sendSMSJS.js" enctype="multipart/form-data" method="POST" id="myformFindParent">
                        <input class="SearchStudentBar" type="text" placeholder="Student Name" id="studentName">
                        <input class="buttons" id="myBtn" type="submit" value="Search" name="submit">              
                      </form>
                  </div>
              </div>
              <div class="message">
              <label  class="titlelabel">Send Message</label>
              <p class="notice">Date when you would like the parents to visit the Office</p>
                <!--For message-->
                <form action="../JAVASCRIPT/sendSMSJS.js" enctype="multipart/form-data" method="POST" id="myformSMS">
                  <!--date-->
                  <input class="datepicker" type="date" name="scheduleDate" id="scheduleDate" placeholder="Date">
                  <input class="datepicker" type="time" name="scheduleTime" id="scheduleTime" placeholder="Time"><br>
                  <p class="notice">Mobile number, to send message to a specific number</p>
                  <input class="searchBar" type="text" placeholder="Student Number Ex. 2000111111" id="studentNumber"> 
                  <input class="searchBar" type="text" placeholder="Mobile Number" id="mobileNumber">
                  <br>
                  <!--textbox-->
                  <textarea class="messageTextBox" placeholder="Your message Here" id="message">Hello, This is the Disciplinary Officer of STI College Global City. We are reaching to you regarding your child's school violation.</textarea>
                  <br>
                  <p class="notice">Below is the your child who violated the school rules and the date when we are hoping to meet you.<br>
                                    Student: Student name<br>
                                    Date and time: dd/mm/yyyy hh/mm</p>
                  <input class="buttons" type="submit" value="Send Message" name="submit">
                </form>
                  <!-- Snackbar element -->
                <div id="snackbar"></div>

              </div>
            </div>
          </div>
            </div>


      <!-- The Modal -->
          <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
              <span class="close">&times;</span>
              <label class="titlelabel">Parent of the Student</label>
              <table>
              <thead>
                  <tr>
                    <th class="th-modal">Student Number</th>
                    <th class="th-modal">Student Name</th>
                    <th class="th-modal">Parent Name</th>
                    <th class="th-modal">Mobile Number</th>
                  </tr>
                  </thead>
                  <tbody id="reportListRows">
                  </tbody>
              </table>      
            </div>
          </div>
          <!-- The History Modal -->
          <div id="historyModal" class="modal1">

            <!-- Modal content -->
            <div class="modal-content1">
              <div class="modal-header">
                <h2>History Message</h2>
                <span class="close-btn">&times;</span>
              </div>
              <div class="modal-body">
                <table>
                <thead>
                    <tr>
                      <th class="th-modal">Notes</th>
                    </tr>
                    </thead>
                    <tbody id="historySMS">
                    </tbody>
                </table>    
              </div>
            </div>
            
          </div>


         
      </div>
    <script src="../JAVASCRIPT/sendSMSJS.js"></script>
</body>
</html>