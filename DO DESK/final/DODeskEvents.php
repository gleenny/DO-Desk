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
        <link rel="stylesheet" href="../CSS/DODesk-EventsStyle.css">
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
    <?php
        if(!isset($_SESSION['userID']) || $_SESSION['userID'] === ''){ ?>
            <script>window.location.href = "DODesk-Login.html";</script>
        <?php }
    ?>
    <!--Left side nav-->
    <div class="wrapper">
        <div class="left-side">

            <!--On Insert Details-->
            <a class="header-link" href="DODESK-InsertingDetails.html">
                <svg id='Pixar_Lamp_2_24' width='19' height='19' viewBox='0 0 19 19' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
                <g transform="matrix(0.42 0 0 0.42 12 12)" >
                <path style="stroke: none; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(144,144,152); fill-rule: nonzero; opacity: 1;" transform=" translate(-25, -25)" d="M 27.257813 1.007813 C 26.824219 0.964844 26.378906 1.042969 25.976563 1.179688 C 25.175781 1.445313 24.390625 1.960938 23.675781 2.675781 C 22.960938 3.386719 22.445313 4.175781 22.179688 4.976563 C 21.914063 5.773438 21.867188 6.753906 22.558594 7.445313 C 23.460938 8.347656 23.996094 9.285156 24.339844 10.25 C 24.3125 10.273438 24.285156 10.296875 24.265625 10.324219 L 13.359375 22.222656 C 13.355469 22.222656 13.351563 22.226563 13.351563 22.226563 C 13.179688 22.371094 13.058594 22.566406 13.011719 22.785156 L 9.148438 32.445313 C 8.992188 32.671875 8.9375 32.949219 8.992188 33.214844 C 9.050781 33.480469 9.210938 33.714844 9.445313 33.859375 L 16 40.414063 L 16 43.03125 C 13.148438 43.164063 11.046875 43.855469 9.628906 44.585938 C 8.835938 44.992188 8.257813 45.40625 7.859375 45.734375 C 7.664063 45.902344 7.511719 46.046875 7.398438 46.160156 C 7.34375 46.21875 7.300781 46.269531 7.257813 46.324219 C 7.234375 46.351563 7.210938 46.375 7.179688 46.421875 C 7.167969 46.445313 7.148438 46.46875 7.117188 46.527344 C 7.105469 46.554688 7.085938 46.585938 7.0625 46.648438 C 7.054688 46.679688 7.027344 46.769531 7.027344 46.769531 C 7.027344 46.773438 7 47 7 47 L 7 48 C 7 48.550781 7.449219 49 8 49 L 26 49 C 26.550781 49 27 48.550781 27 48 L 27 47 C 27 46.761719 26.914063 46.53125 26.761719 46.347656 C 26.761719 46.347656 25.953125 45.433594 24.375 44.613281 C 22.957031 43.878906 20.855469 43.167969 18 43.03125 L 18 40.535156 L 23.554688 36.832031 C 23.816406 36.65625 23.980469 36.367188 24 36.054688 C 24.015625 35.738281 23.882813 35.433594 23.640625 35.234375 L 18.3125 30.792969 L 22.769531 23.65625 C 22.960938 23.429688 23.046875 23.132813 23 22.84375 L 23 15 C 23 14.898438 22.988281 14.800781 22.957031 14.703125 L 24.839844 12.65625 C 24.882813 13.082031 24.925781 13.511719 24.953125 13.953125 C 25.097656 16.300781 25.085938 18.914063 27.085938 20.914063 C 27.136719 20.96875 27.195313 21.015625 27.257813 21.054688 C 28.570313 22.207031 30.515625 22.207031 32.445313 21.5625 C 34.457031 20.890625 36.613281 19.507813 38.5625 17.5625 C 40.507813 15.613281 41.890625 13.457031 42.5625 11.445313 C 43.203125 9.523438 43.207031 7.589844 42.074219 6.28125 C 42.03125 6.214844 41.980469 6.152344 41.921875 6.097656 C 41.921875 6.09375 41.917969 6.089844 41.914063 6.085938 C 41.90625 6.078125 41.902344 6.074219 41.894531 6.070313 C 41.894531 6.066406 41.890625 6.066406 41.890625 6.0625 C 41.886719 6.0625 41.882813 6.058594 41.878906 6.054688 C 41.859375 6.039063 41.835938 6.023438 41.816406 6.007813 C 41.664063 5.863281 41.503906 5.734375 41.332031 5.625 C 39.164063 3.976563 36.804688 4.039063 34.769531 4 C 32.5625 3.957031 30.660156 3.851563 28.453125 1.570313 C 28.109375 1.214844 27.691406 1.050781 27.257813 1.007813 Z M 27.015625 2.960938 C 29.636719 5.667969 32.429688 5.957031 34.730469 6 C 34.882813 6.003906 35.015625 6.007813 35.164063 6.007813 C 34.398438 6.375 33.628906 6.839844 32.863281 7.382813 C 32.859375 7.386719 32.855469 7.386719 32.851563 7.390625 C 32.734375 7.445313 32.632813 7.523438 32.546875 7.621094 C 32.542969 7.621094 32.542969 7.621094 32.542969 7.625 C 31.828125 8.160156 31.121094 8.757813 30.4375 9.4375 C 29.734375 10.144531 29.113281 10.878906 28.566406 11.621094 C 28.527344 11.660156 28.492188 11.707031 28.457031 11.753906 C 27.863281 12.578125 27.363281 13.414063 26.972656 14.234375 C 26.964844 14.097656 26.957031 13.976563 26.949219 13.832031 C 26.800781 11.410156 26.453125 8.511719 23.96875 6.03125 C 24.042969 6.101563 23.941406 6.019531 24.078125 5.609375 C 24.214844 5.195313 24.566406 4.609375 25.089844 4.089844 C 25.613281 3.566406 26.195313 3.214844 26.609375 3.074219 C 27.027344 2.933594 27.09375 3.042969 27.015625 2.960938 Z M 38.808594 7.007813 C 39.417969 6.976563 39.898438 7.089844 40.246094 7.304688 C 40.332031 7.375 40.421875 7.4375 40.515625 7.515625 C 41.046875 8.066406 41.203125 9.199219 40.667969 10.8125 C 40.125 12.441406 38.902344 14.390625 37.144531 16.144531 C 35.390625 17.902344 33.441406 19.125 31.8125 19.667969 C 30.183594 20.207031 29.042969 20.042969 28.5 19.5 C 27.957031 18.957031 27.792969 17.816406 28.332031 16.1875 C 28.558594 15.511719 28.929688 14.769531 29.378906 14.019531 C 30.082031 14.628906 31 15 32 15 C 34.199219 15 36 13.199219 36 11 C 36 10 35.628906 9.082031 35.019531 8.378906 C 35.769531 7.929688 36.511719 7.558594 37.1875 7.335938 C 37.796875 7.128906 38.339844 7.027344 38.808594 7.007813 Z M 33.347656 9.53125 C 33.746094 9.894531 34 10.410156 34 11 C 34 12.117188 33.117188 13 32 13 C 31.410156 13 30.894531 12.746094 30.53125 12.347656 C 30.929688 11.84375 31.367188 11.339844 31.855469 10.855469 C 32.339844 10.367188 32.84375 9.929688 33.347656 9.53125 Z M 21 16.84375 L 21 22 L 16.273438 22 Z M 14.675781 24 L 20.195313 24 L 16.355469 30.144531 L 11.6875 31.480469 Z M 16.765625 32.105469 L 21.332031 35.910156 L 17.125 38.714844 L 11.90625 33.496094 Z M 16.863281 45.003906 C 16.957031 45.015625 17.046875 45.015625 17.136719 45.003906 C 20.121094 45.023438 22.164063 45.71875 23.453125 46.386719 C 24.089844 46.714844 24.035156 46.773438 24.320313 47 L 9.5625 47 C 9.835938 46.800781 10.085938 46.601563 10.542969 46.363281 C 11.832031 45.703125 13.875 45.023438 16.863281 45.003906 Z" stroke-linecap="round" />
                </g>
                </svg>
            </a>
      
            <!--On Transcribe Case-->
            <a class="header-link" href="DODesk-OnTranscribe.html">
            <svg id='Interface_Setting_Tool_Box_24' width='26' height='26' viewBox='0 0 23 23' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#4252ce' opacity='0'/>
                    <g transform="matrix(1.43 0 0 1.43 12 12)" >
                    <g style="" >
                    <g transform="matrix(1 0 0 1 0 2)" >
                    <rect style="stroke:rgb(152,152,160); stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" x="-6.5" y="-4.5" rx="1" ry="1" width="13" height="9" />
                    </g>
                    <g transform="matrix(1 0 0 1 0 1.5)" >
                    <line style="stroke: rgb(152,152,160); stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" x1="-6.5" y1="0" x2="6.5" y2="0" />
                    </g>
                    <g transform="matrix(1 0 0 1 0 1.5)" >
                    <line style="stroke: rgb(152,152,160); stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" x1="0" y1="-1" x2="0" y2="1" />
                    </g>
                    <g transform="matrix(1 0 0 1 0 -4)" >
                    <path style="stroke: rgb(152,152,160); stroke-width: 1; stroke-dasharray: none; stroke-linecap: round; stroke-dashoffset: 0; stroke-linejoin: round; stroke-miterlimit: 4; fill: none; fill-rule: nonzero; opacity: 1;" transform=" translate(-7, -3)" d="M 10 4.5 C 10 2.8431457505076194 8.65685424949238 1.5 7 1.5 L 7 1.5 C 5.343145750507619 1.5 4 2.8431457505076194 4 4.5" stroke-linecap="round" />
                    </g>
                    </g>
                    </g>
            </svg>
            </a>
      
            <!--Message-->
            <!--http://127.0.0.1:5500/DO%20DESK/Final%20HTML/DODESK-SMS.html#-->
            <a class="header-link" href="DODESK-SMS.html" > 
            <svg viewBox="0 0 512 512" fill="currentColor" >
            <path d="M467 76H45a45 45 0 00-45 45v270a45 45 0 0045 45h422a45 45 0 0045-45V121a45 45 0 00-45-45zm-6.3 30L287.8 278a44.7 44.7 0 01-63.6 0L51.3 106h409.4zM30 384.9V127l129.6 129L30 384.9zM51.3 406L181 277.2l22 22c14.2 14.1 33 22 53.1 22 20 0 38.9-7.9 53-22l22-22L460.8 406H51.3zM482 384.9L352.4 256 482 127V385z" /></svg>
            </a>
            <!--Settings-->
            <a class="header-link" href="DO-Settings.html#">
            <svg viewBox="0 0 512 512" fill="currentColor">
            <path d="M272 512h-32c-26 0-47.2-21.1-47.2-47.1V454c-11-3.5-21.8-8-32.1-13.3l-7.7 7.7a47.1 47.1 0 01-66.7 0l-22.7-22.7a47.1 47.1 0 010-66.7l7.7-7.7c-5.3-10.3-9.8-21-13.3-32.1H47.1c-26 0-47.1-21.1-47.1-47.1v-32.2c0-26 21.1-47.1 47.1-47.1H58c3.5-11 8-21.8 13.3-32.1l-7.7-7.7a47.1 47.1 0 010-66.7l22.7-22.7a47.1 47.1 0 0166.7 0l7.7 7.7c10.3-5.3 21-9.8 32.1-13.3V47.1c0-26 21.1-47.1 47.1-47.1h32.2c26 0 47.1 21.1 47.1 47.1V58c11 3.5 21.8 8 32.1 13.3l7.7-7.7a47.1 47.1 0 0166.7 0l22.7 22.7a47.1 47.1 0 010 66.7l-7.7 7.7c5.3 10.3 9.8 21 13.3 32.1h10.9c26 0 47.1 21.1 47.1 47.1v32.2c0 26-21.1 47.1-47.1 47.1H454c-3.5 11-8 21.8-13.3 32.1l7.7 7.7a47.1 47.1 0 010 66.7l-22.7 22.7a47.1 47.1 0 01-66.7 0l-7.7-7.7c-10.3 5.3-21 9.8-32.1 13.3v10.9c0 26-21.1 47.1-47.1 47.1zM165.8 409.2a176.8 176.8 0 0045.8 19 15 15 0 0111.3 14.5V465c0 9.4 7.7 17.1 17.1 17.1h32.2c9.4 0 17.1-7.7 17.1-17.1v-22.2a15 15 0 0111.3-14.5c16-4.2 31.5-10.6 45.8-19a15 15 0 0118.2 2.3l15.7 15.7a17.1 17.1 0 0024.2 0l22.8-22.8a17.1 17.1 0 000-24.2l-15.7-15.7a15 15 0 01-2.3-18.2 176.8 176.8 0 0019-45.8 15 15 0 0114.5-11.3H465c9.4 0 17.1-7.7 17.1-17.1v-32.2c0-9.4-7.7-17.1-17.1-17.1h-22.2a15 15 0 01-14.5-11.2c-4.2-16.1-10.6-31.6-19-45.9a15 15 0 012.3-18.2l15.7-15.7a17.1 17.1 0 000-24.2l-22.8-22.8a17.1 17.1 0 00-24.2 0l-15.7 15.7a15 15 0 01-18.2 2.3 176.8 176.8 0 00-45.8-19 15 15 0 01-11.3-14.5V47c0-9.4-7.7-17.1-17.1-17.1h-32.2c-9.4 0-17.1 7.7-17.1 17.1v22.2a15 15 0 01-11.3 14.5c-16 4.2-31.5 10.6-45.8 19a15 15 0 01-18.2-2.3l-15.7-15.7a17.1 17.1 0 00-24.2 0l-22.8 22.8a17.1 17.1 0 000 24.2l15.7 15.7a15 15 0 012.3 18.2 176.8 176.8 0 00-19 45.8 15 15 0 01-14.5 11.3H47c-9.4 0-17.1 7.7-17.1 17.1v32.2c0 9.4 7.7 17.1 17.1 17.1h22.2a15 15 0 0114.5 11.3c4.2 16 10.6 31.5 19 45.8a15 15 0 01-2.3 18.2l-15.7 15.7a17.1 17.1 0 000 24.2l22.8 22.8a17.1 17.1 0 0024.2 0l15.7-15.7a15 15 0 0118.2-2.3z" />
            <path d="M256 367.4c-61.4 0-111.4-50-111.4-111.4s50-111.4 111.4-111.4 111.4 50 111.4 111.4-50 111.4-111.4 111.4zm0-192.8a81.5 81.5 0 000 162.8 81.5 81.5 0 000-162.8z" /></svg>
            </a>
      
            <a class="header-link" href="DODesk-login.html"><svg viewBox="0 0 512 512" fill="currentColor">
              <path d="M255.2 468.6H63.8a21.3 21.3 0 01-21.3-21.2V64.6c0-11.7 9.6-21.2 21.3-21.2h191.4a21.2 21.2 0 100-42.5H63.8A63.9 63.9 0 000 64.6v382.8A63.9 63.9 0 0063.8 511H255a21.2 21.2 0 100-42.5z" />
              <path d="M505.7 240.9L376.4 113.3a21.3 21.3 0 10-29.9 30.3l92.4 91.1H191.4a21.2 21.2 0 100 42.6h247.5l-92.4 91.1a21.3 21.3 0 1029.9 30.3l129.3-127.6a21.3 21.3 0 000-30.2z" />
            </svg>
          </a>
          </div>
          <!--Head Nav-->
          <div class="main-container">
            <div class="header">
             <a class="header-link" href="DODESK-Dashboard.html"><svg viewBox="-6 0 512 512" fill="currentColor">
               <path d="M227.7 357.5a15.1 15.1 0 0021.3 0l54-54a15.1 15.1 0 10-21.4-21.3l-43.3 43.2-19.7-19.7a15.1 15.1 0 00-21.4 21.4zm0 0" />
               <path d="M250.1 439.8a120.1 120.1 0 10-120-120c0 66.2 53.8 120 120 120zm0-209.7a89.9 89.9 0 010 179.5 89.9 89.9 0 010-179.5zm0 0" />
               <path d="M451.3 32.2h-27.5v-17a15.1 15.1 0 00-30.3 0v17h-29.7v-17a15.1 15.1 0 00-30.2 0v17h-167v-17a15.1 15.1 0 00-30.2 0v17h-29.7v-17a15.1 15.1 0 00-30.2 0v17H48.9A49 49 0 000 81v382A49 49 0 0048.9 512h402.4a49 49 0 0049-48.9v-382a49 49 0 00-49-49zm18.7 431c0 10.2-8.4 18.6-18.7 18.6H49A18.7 18.7 0 0130.2 463V158H470zM30.2 81c0-10.3 8.4-18.7 18.7-18.7h27.6v17.1a15.1 15.1 0 0030.2 0v-17h29.7v17a15.1 15.1 0 0030.3 0v-17h166.9v17a15.1 15.1 0 0030.2 0v-17h29.7v17a15.1 15.1 0 0030.3 0v-17h27.5c10.3 0 18.7 8.3 18.7 18.6v46.6H30.2zm0 0" />
              </svg>
              Dashboard
             </a>
             
             <a class="header-link" href="DODesk-Records.html"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
               <path d="M10 13a2 2 0 110-4 2 2 0 010 4zm0-2.5a.5.5 0 100 1 .5.5 0 000-1z" />
               <path d="M20.3 11.8h-8.8a.8.8 0 010-1.6h8.8a.8.8 0 010 1.6zM8.5 11.8H3.7a.8.8 0 010-1.6h4.8a.8.8 0 010 1.6zM15 19a2 2 0 110-4 2 2 0 010 4zm0-2.5a.5.5 0 100 1 .5.5 0 000-1z" />
               <path d="M20.3 17.8h-3.8a.8.8 0 010-1.6h3.8a.8.8 0 010 1.6zM13.5 17.8H3.7a.8.8 0 010-1.6h9.8a.8.8 0 010 1.6z" />
               <path d="M21.3 23H2.6A2.8 2.8 0 010 20.2V3.9C0 2.1 1.2 1 2.8 1h18.4C22.9 1 24 2.2 24 3.8v16.4c0 1.6-1.2 2.8-2.8 2.8zM2.6 2.5c-.6 0-1.2.6-1.2 1.3v16.4c0 .7.6 1.3 1.3 1.3h18.4c.7 0 1.3-.6 1.3-1.3V3.9c0-.7-.6-1.3-1.3-1.3z" />
               <path d="M23.3 6H.6a.8.8 0 010-1.5h22.6a.8.8 0 010 1.5z" />
              </svg>
              Records
             </a>

             <a class="header-link" href="DODesk-Reports.html"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
               <path d="M76 240c12.1 0 23.1-4.8 31.2-12.6l44.2 22A44.9 44.9 0 00196 300a45 45 0 0040.6-64.4l60-60a45 45 0 0062.3-54l52.2-39.2a45 45 0 10-18-24l-52.2 39.2a45 45 0 00-65.5 56.8l-60 60a44.7 44.7 0 00-50.6 8.2l-44.2-22A44.9 44.9 0 0076 150a45 45 0 000 90zM436 30a15 15 0 110 30 15 15 0 010-30zm-120 90a15 15 0 110 30 15 15 0 010-30zM196 240a15 15 0 110 30 15 15 0 010-30zM76 180a15 15 0 110 30 15 15 0 010-30zm0 0" />
               <path d="M497 482h-16V165a15 15 0 00-15-15h-60a15 15 0 00-15 15v317h-30V255a15 15 0 00-15-15h-60a15 15 0 00-15 15v227h-30V375a15 15 0 00-15-15h-60a15 15 0 00-15 15v107h-30V315a15 15 0 00-15-15H46a15 15 0 00-15 15v167H15a15 15 0 100 30h482a15 15 0 100-30zm-76-302h30v302h-30zm-120 90h30v212h-30zM181 390h30v92h-30zM61 330h30v152H61zm0 0" />
              </svg>
              Reports
             </a>   
             
             <a class="header-link active" href="DODesk-Events.html"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
              <path d="M500 113.3C326.1 78.7 337.4 80.5 333.4 81.2L281 91.7A111.2 111.2 0 00176 17c-48.6 0-90 31.3-105 74.8L18 81.3A15 15 0 000 96v352a15 15 0 0012 14.7l162.2 32.2c3.6.4-7.6 2.3 161.8-31.6l158 31.4a15 15 0 0018-14.7V128a15 15 0 00-12-14.7zM176 47a81 81 0 0181 81c0 37.7-60.3 133.3-81 165-20.7-31.6-81-127.3-81-165a81 81 0 0181-81zM30 114.2l35.2 7a112 112 0 00-.2 6.8c0 25 16.4 65.4 50 123.4 19.7 33.9 39 63 46 73.2v137.1l-131-26zm161 210.4c7-10.2 26.3-39.3 46-73.2 33.6-58 50-98.4 50-123.4 0-2.3 0-4.6-.2-6.9l34.2-6.8v321.4l-130 26zm291 137.1l-131-26V114.3l131 26z" />
              <path d="M176 175a47 47 0 10-.1-94.1 47 47 0 00.1 94zm0-64a17 17 0 110 34 17 17 0 010-34z" /></svg>
             Events
            </a>     
        </div>
        
        <!--first box-->
        <div class="user-box first-box" style="--delay: .1s">
            <!--Day, Date and Time Display-->
            <div id="current-datetime" class="current-datetime"></div>
        </div>

        <div class="user-box second-box" style="--delay: .1s">

            <div class="calendarCard card" style="--delay: .2s">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <svg id="prev-month" class="nav-button" width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
                            <g transform="matrix(0.48 0 0 0.48 12 12)" >
                            <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: #4154d1; fill-rule: nonzero; opacity: 1;" transform=" translate(-25, -25)" d="M 41 4 L 9 4 C 6.24 4 4 6.24 4 9 L 4 41 C 4 43.76 6.24 46 9 46 L 41 46 C 43.76 46 46 43.76 46 41 L 46 9 C 46 6.24 43.76 4 41 4 z M 16 25 L 30 16 L 30 34 L 16 25 z" stroke-linecap="round" />
                            </g>
                            </svg>

                        <h2 id="month-year"></h2>
                        
                        <svg id="next-month" class="nav-button" width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'><rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
                            <g transform="matrix(1.11 0 0 1.11 12 12)" >
                            <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill:#4154d1; fill-rule: nonzero; opacity: 1;" transform=" translate(-12, -12)" d="M 19 3 L 5 3 C 3.897 3 3 3.897 3 5 L 3 19 C 3 20.103 3.8970000000000002 21 5 21 L 19 21 C 20.103 21 21 20.103 21 19 L 21 5 C 21 3.897 20.103 3 19 3 z M 16 12 L 9 16.5 L 9 7.5 L 16 12 z" stroke-linecap="round" />
                            </g>
                            </svg>
                        
                    </div>
                    <table id="calendar">
                        <thead>
                            <tr>
                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                            </tr>
                        </thead>
                        <tbody id="calendar-body">
                            <!-- Calendar dates will be populated here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="scheduledCard card" style="--delay: .2s">
                <div class="schedule-table card">
                    <h3>Today's Scheduled</h3>
                    <table id="schedule-table">
                        <tbody id="schedule-body">
                            <!-- Scheduled events will be populated here by JavaScript -->
                            <button id="schedule-btn" class="schedule-button">Schedule an Event</button>

                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>


            <div class="user-box second-box" style="--delay: .1s">
                <div class="todaysSchedule card" style="--delay: .2s">
                    <div id="monthly-events">
                        <div class="monthlyHeader">
                            <svg id="prev-month-events" class="nav-button" width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'>
                                <rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
                                <g transform="matrix(0.48 0 0 0.48 12 12)">
                                    <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: #4154d1; fill-rule: nonzero; opacity: 1;" transform="translate(-25, -25)" d="M 41 4 L 9 4 C 6.24 4 4 6.24 4 9 L 4 41 C 4 43.76 6.24 46 9 46 L 41 46 C 43.76 46 46 43.76 46 41 L 46 9 C 46 6.24 43.76 4 41 4 z M 16 25 L 30 16 L 30 34 L 16 25 z" stroke-linecap="round"/>
                                </g>
                            </svg>
                            <span id="month-year-events"></span>
                            <svg id="next-month-events" class="nav-button" width='24' height='24' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'>
                                <rect width='24' height='24' stroke='none' fill='#000000' opacity='0'/>
                                <g transform="matrix(1.11 0 0 1.11 12 12)">
                                    <path style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill:#4154d1; fill-rule: nonzero; opacity: 1;" transform="translate(-12, -12)" d="M 19 3 L 5 3 C 3.897 3 3 3.897 3 5 L 3 19 C 3 20.103 3.8970000000000002 21 5 21 L 19 21 C 20.103 21 21 20.103 21 19 L 21 5 C 21 3.897 20.103 3 19 3 z M 16 12 L 9 16.5 L 9 7.5 L 16 12 z" stroke-linecap="round"/>
                                </g>
                            </svg>
                        </div>
                
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Event</th>
                                </tr>
                            </thead>
                            <tbody id="events-body"></tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        
             <!-- Popup for Scheduling -->
             <div id="schedule-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Schedule an Event</h2>
                    <form id="schedule-form">
                        <label for="event-date">Date:</label>
                        <input type="date" id="event-date" name="event-date" required>
                        <label for="event-name">Event Name:</label>
                        <input type="text" id="event-name" name="event-name" required>
                        <button type="submit">Add Event</button>
                    </form>
                </div>
            </div>

            <!-- Event Details Modal -->
                <div id="event-details-modal" class="modal">
                    <div class="modal-content">
                        <span class="close-details">&times;</span>
                        <div id="event-details-content"></div>
                    </div>
                </div>


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