<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="#">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Click on the "Choose File" button to upload a file:</p>
    <p>File Supported: mp3, mp4, mpeg, mpga, m4a, wav, and webm. File size should not exceed 25mb</p>

    <button id="record">record</button>
    <button id="stop">stop</button>
    <br>
    <br>
    

    <form action="../JAVASCRIPT/upload.js" method="post" enctype="multipart/form-data" id="myform">
        <input type="file" id="myFile" name="filename">
        <input type="submit" value="Upload File" name="submit">
    </form>

    <audio controls id="audio">
        <source id="audioPlayer" src="">
    </audio>
    <br>
    <p>Transcribe:</p>
    <p id="myTextarea">Hello world</p>
    <p id="sampleTextarea">Hello world</p>

    <script src="../JAVASCRIPT/upload.js?version=2"></script>
</body>
</html>