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
        <div class="AddingStudent card" style="--delay: .1s">

          <div class="title">Message Parent</div>
          <!--Search Student-->
      <label>Search Student</label>
        <form action="../JAVASCRIPT/sendSMSJS.js" enctype="multipart/form-data" method="POST" id="myformFindParent">
            <input class="SearchStudentBar" type="text" placeholder="Student Name" id="studentName">
            <input class="buttons" type="submit" value="Look for Student" name="submit">
        </form>
    <br>
    <br>
    <table>
        <thead>
            <tr>
              <th>Student Number</th>
              <th>Student Name</th>
              <th>Parent Name</th>
              <th>Mobile Number</th>
            </tr>
            </thead>
            <tbody id="reportListRows">
            </tbody>
    </table>
    <br>
    <br>
    <div class="message">
      <div class="title">Send Message</div>
        <!--For message-->
        <form action="../JAVASCRIPT/sendSMSJS.js" enctype="multipart/form-data" method="POST" id="myformSMS">
            <input class="searchBar" type="text" placeholder="Student Number" id="studentNumber">
            <input class="textType" type="date" name="scheduleDate" id="scheduleDate" placeholder="Date">
            <br>
            <textarea class="messageTextBox" placeholder="Your message Here, leave blank for preset message" id="message"></textarea>
            <br>
            <input class="buttons" type="submit" value="Send Message" name="submit">
    </form>
    </div>
  </div>
    </div>
    </div>
    <script src="../JAVASCRIPT/sendSMSJS.js"></script>
</body>
</html>