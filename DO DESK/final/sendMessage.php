<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <label>Search Student</label>
    <form action="../JAVASCRIPT/sendSMSJS.js" enctype="multipart/form-data" method="POST" id="myformFindParent">
        <input type="text" placeholder="Student Name" id="studentName">
    <input type="submit" value="Look for Student" name="submit">
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
    <label>Send message</label>
    <form action="../JAVASCRIPT/sendSMSJS.js" enctype="multipart/form-data" method="POST" id="myformSMS">
        <input type="text" placeholder="Student Number" id="studentNumber">
        <textarea placeholder="Your message Here" id="message"></textarea>
    <input type="submit" value="Send Message" name="submit">
    </form>

    <script src="../JAVASCRIPT/sendSMSJS.js"></script>
</body>
</html>