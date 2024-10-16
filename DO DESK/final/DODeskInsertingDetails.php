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
        <link rel="stylesheet" href="../CSS/DODESK-InsertingDetails.css">
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
        <!--first box-->
        <div class="user-box first-box" style="--delay: .1s">
            <div class="AddingStudent card" style="--delay: .1s">
                <div class="title">Create new student</div>
                <br>

                <div class="AddingStudent-wrapper">
                     <!--Add student-->
                    <label>Register Student</label>
                    <form action="../JAVASCRIPT/addStudentsJS.js" enctype="multipart/form-data" method="POST" id="myformStudent">
                        <input type="text" placeholder="Student Number" id="studentNumber">
                        <input type="text" placeholder="First Name" id="studentfirstName">
                        <input type="text" placeholder="Middle Name" id="studentMiddleName">
                        <input type="text" placeholder="Last Name" id="studentLastName">
                        <input type="text" placeholder="Course" id="course">
                        <input type="text" placeholder="Section" id="section">
                    <input type="submit" value="Submit Student" name="submit">
                    </form>
                    <br>
                    <br>
                    <!--Add Parent--> 
                    <label>Add Parent</label> 
                    <form action="../JAVASCRIPT/addStudentsJS.js" enctype="multipart/form-data" method="POST" id="myformParent">
                        <input type="text" placeholder="First Name" id="parentfirstName">
                        <input type="text" placeholder="Middle Name" id="parentMiddleName">
                        <input type="text" placeholder="Last Name" id="parentLastName">
                        <input type="text" placeholder="Mobile Number" id="mobileNumber">
                    <input type="submit" value="Submit Parent" name="submit">
                    </form>
                    <br>
                    <br>
                    <!--Student Parent Pairing--> 
                    <label>Add Parent</label> 
                    <form action="../JAVASCRIPT/addStudentsJS.js" enctype="multipart/form-data" method="POST" id="myformPairing">
                        <input type="text" placeholder="Student Number" id="studentNumberPair">
                        <input type="text" placeholder="Parent Number" id="parentNumberPair">
                    <input type="submit" value="Submit Pairing" name="submit">
                    </form>

                </div>
            </div>
        </div>

        <!--second box-->
        
    
    <!--adding student script-->
    <script src="../JAVASCRIPT/addStudentsJS.js"></script>

    
    <script src="script.js"></script>
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