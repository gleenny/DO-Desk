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
</head>

<body>
  <div class="wrapper">
    <?php
    require_once 'userHeader.php';
    ?>
      <div class="user-box first-box" style="--delay: .1s">

        <div class="SMSPage card" style="--delay: .1s">

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
          
      <!-- The Modal -->
          <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
              <span class="close">&times;</span>
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

          <div class="message">
              <label  class="titlelabel">Send Message</label>
              <p class="notice">Date when you would like the parents to visit the Office (for preset message)</p>
                <!--For message-->
                <form action="../JAVASCRIPT/sendSMSJS.js" enctype="multipart/form-data" method="POST" id="myformSMS">
                  <!--date-->
                  <input class="datepicker" type="date" name="scheduleDate" id="scheduleDate" placeholder="Date"><br>
                  <!--Student Number-->
                  <h4 class="titlelabel">Option to send a message</h4>

                  <p class="notice">Student number, to message all of student's parents/guardian</p>
                  <input class="searchBar" type="text" placeholder="Student Number" id="studentNumber"> 
                  <h5 class="titlelabel">OR</h5>

                  <p class="notice">Enter the Student name and the Parent contact number</p>
                  <input class="searchBar" type="text" placeholder="Student Name (for preset)" id="studentNameSMS">
                  <input class="searchBar" type="text" placeholder="Parent's Mobile Number" id="mobileNumber">
                  <br>
                  <!--textbox-->
                  <textarea class="messageTextBox" placeholder="Your message Here, leave blank for preset message" id="message"></textarea>
                  <br>
                  <input class="buttons" type="submit" value="Send Message" name="submit">
                </form>
                  <!-- Snackbar element -->
                <div id="snackbar"></div>

              </div>
            </div>
          </div>
      </div>
    <script src="../JAVASCRIPT/sendSMSJS.js"></script>
</body>
</html>