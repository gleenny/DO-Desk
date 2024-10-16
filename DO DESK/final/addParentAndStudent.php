<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--Add student-->
    <label>Add Student</label>
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

    <script src="../JAVASCRIPT/addStudentsJS.js"></script>
</body>
</html>