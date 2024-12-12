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
        <link rel="stylesheet" href="../CSS/DODesk-RecordsStyle.css">
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
      <div class="user-box zero-box" style="--delay: .6s">
        <p style="font-weight: bold;">Violation Records</p>
      </div>
        <!--First Flow-->
        <div class="user-box first-box" style="--delay: .6s">
            <!--searching violations-->
            <div class="form-container">
            <p>Search data violations</p>

                <form class="form2" id="searchForm">
                    <div class="form2-row"><!--first row-->
                        <div class="form2-group"><!--column 1-->
                            <input class="textType" type="text" name="searchNumber" id="searchNumber" placeholder="Student Number">
                        </div>
                        <div class="form2-group"><!--column 2-->
                            <input class="textType" type="text" name="searchName" id="searchName" placeholder="Student Name">
                        </div>
                    </div>
                    <div class="form2-row"><!--second row-->
                        <div class="form2-group"><!--column 1-->
                            <select class="textType" name="searchCourse" id="searchCourse" value=" ">
                              <option value="">Course</option>
                            </select>
                        </div>
                        <div class="form2-group"><!--column 2-->
                            <select class="textType" name="typeOfViolation" id="typeOfViolation" value=" ">
                              <option value="">Violation Type</option>
                                <option value="Minor">Minor</option>
                                <option value="Major">Major</option>
                            </select>
                        </div>
                        <div class="form2-group"><!--column 3-->
                            <select class="textType" name="status" id="status" value=" ">
                              <option value="">Status</option>
                                <option value="0">Resolve</option>
                                <option value="1">Unresolve</option>
                            </select>
                        </div>
                    </div>
                    <div class="form2-row"><!--third row-->
                        <div class="form2-group"><!--column 1-->
                            <select class="textType"name="searchCase" id="searchCase" value=" "> <br>
                              <option value="">Violation Case</option>
                            </select> 
                        </div>
                    </div>
                    <div class="form2-row"><!--fourth row-->
                        
                        
                    </div>
                    <!--Outside element-->
                    <button type="submit" id="searchbtn" class="searchbutton">Search</button>
                </form>
            </div>
           
        </div>  
        <!--date filter-->
        <div class="user-box first-box" style="--delay: .6s">
            <!--searching violations-->
            <div class="form-container">
            <p>Date Filter</p>
                <form class="form2" id="searchForm">
                    <div class="form2-row"><!--first row-->
                        <div class="form2-group"><!--column 1-->
                          <!-- Date Search -->
                          <input class="textType" type="date" name="searchDate" id="searchDate" placeholder="Date"><br>
                        </div>
                    </div>
                      -
                    <div class="form2-row"><!--second row-->
                        <div class="form2-group"><!--column 1-->
                          <!--Until Date-->
                        <input class="textType" type="date" name="searchUntilDate" id="searchUntilDate" placeholder="untilDate">
                        </div>
                    </div>
                    <!--Outside element-->
                </form>
            </div>
           
        </div>  
        <!--Second Flow modals-->
        <div class="user-box second-box">
          <!-- Trigger/Open The Modal -->
           <div class="modalSection" style="--delay: .7s">
           <button class="cards-button button" id="btnSubmit"  style="--delay: .7s">Submit Violation</button>
           <button class="cards-button button" id="btnUpdate"  style="--delay: .7s">Update Status</button>
           <button class="cards-button button" id="exportViolations" style="--delay: .7s">Export as Excel</button>
           <button class="cards-button button" id="exportPDFViolations" style="--delay: .7s">Print or export as PDF</button>
           </div>

              <!-- The Modal Register Violation -->
              <div id="modalSubmit" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                  <div class="title">Sumbit Violation</div>
                  <!--Adding Violations-->
                  <div class="form-container">
                    <form class="formModal" action="../JAVASCRIPT/DODeskRecordsJS.js" enctype="multipart/form-data" method="POST" id="myform">
                        <div class="formModal-row">
                          <div class="formModal-group">
                          <input type="text" placeholder="Student Number" id="studentNumber"> <br>

                          </div>
                        </div>
                        <div class="formModal-row">
                          <div class="formModal-group">
                          <select class="violationdrp"name="violationCase" id="violationCase" value=" "> <br>
                          </select> 
                          </div>
                        </div>
                        <div class="formModal-row">
                          <div class="formModal-group">
                          <input class="modalBtn" type="submit" value="Submit Violation" name="submit" id="submitViolation"> <br>
                            
                          </div>
                        </div>
                        <p style="font-weight: bold;">Batch violation</p>
                        <input id="violationExcel" type="file" accept=".xlsx, .xls">
                        <input class="modalBtn" id="submitViolationExcel" class="modalBtn" type="button" value="submit violation excel">
                      </form>
                  </div>
                   
                </div>
              </div>

                <!-- The Modal message Violation --> 
              <div id="modalMessage" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <!--message notif-->
                  <div id="messageParent">First name's violations</div>
                    <div>
                      <table>
                        <thead>
                          <tr>
                            <th>Violation ID</th>
                            <th>Type Of Violation</th>
                            <th>Case</th>
                            <th>Status</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody id="studentViolations">
                        </tbody>
                      </table>
                    </div>
                    <button class="modalBtn" id="sendMessage">Notify Parents</button>
                    <button class="modalBtn" id="cancel">Cancel</button>
                  </div>
              </div>

              
              <!-- The Modal -->
              <div id="modalUpdate" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                  <div class="title">Update Status</div>
                    <div class="form-container">
                      <form class="formModal" action="../JAVASCRIPT/DODesk-RecordsJS.js" enctype="multipart/form-data" method="POST" id="updateStatusForm">
                        <div class="formModal-row">
                          <div class="formModal-group">
                            <select name="violationID" id="violationID" value=" ">
                            </select>
                          </div>
                        </div>
                        <div class="formModal-row">
                          <div class="formModal-group">
                            <select name="violationStatus" id="violationStatus" value=" "><br>
                              <option value="Resolve">Resolve</option>
                              <option value="Unresolve">Unresolve</option>
                            </select>
                          </div>
                        </div>
                        <div class="formModal-row">
                          <div class="formModal-group">
                            <input class="modalBtn" type="submit" value="Update Status" name="submit">
                          </div>
                        </div>                      
                      </form>
                    </div>
                  
                </div>    
              </div>

            <!--The Modal Notify Parent-->
            <div id="modalSendMessage" class="modal">
                <div class="modal-content">
                        <span class="close">&times;</span>
                          <form action="../JAVASCRIPT/DODeskRecordsJS.js" enctype="multipart/form-data" method="POST" id="myformMessage">
                            <div class="title">Message student's parents</div>
                            <div id="studentNameSMS">student Name</div> 
                            <div id="studentNumberSMS">student Number</div>
                            <input type="date" name="schedDate" id="schedDate" placeholder="Date">
                            <textarea class="messageTextBox" id="messageText" placeholder="Your message here, leave blank for preset message"></textarea>
                            <input class="modalBtn" type="submit" value="Notify Parents" name="submit" id="notifyParents" > 
                          </form>
                </div>
            </div>
       </div>
      
        <!--Third Flow table-->
        <div class="user-box third-box">
          <!--List Module-->
          <div class="cards-wrapper" style="--delay: .9s">
            <div class="cards-header">
              <div class="cards-view">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                <rect x="3" y="4" width="16" height="16" rx="2" ry="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                
                <span style="font-weigth: bold;"class="today"> Violation List</span>
              </div>
            </div>

            <div class="cards card">
              <div id="divViolationtbl">
              <table class="table" id="violationTable">
                <thead>
                <tr>
                  <th>Violation ID</th>
                  <th>Record By</th>
                  <th>Student number</th>
                  <th>Student Name</th>
                  <th>Course</th>
                  <th>Type Of Violation</th>
                  <th>Case</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Handled by</th>
                </tr>
                </thead>

                <tbody id="reportListRows">
                </tbody>
              </table>
              </div>
            </div>

           </div>
        </div>
        <br>
        <br>

        <div class="user-box fourth-box" style="--delay: .8s">
          <p style="font-weight: bold;">Sanction Records</p>
        </div>
        
          <!--searching sanction-->
          <div class="user-box fifth-box" style="--delay: .9s">
            <!--searching violations-->
            <div class="form-container">
            <p>Search information from the violation table</p>

              <form class="form1" id="searchSanctionForm">
                <div class="form1-row"><!--first row-->
                  <div class="form1-group"><!--column 1-->
                    <input class="textType" type="text" name="sanctionID" id="sanSanctionID" placeholder="Sanction ID">
                  </div>
                  <div class="form1-group"><!--column 2-->
                    <input class="textType" type="text" name="violationID" id="sanViolationID" placeholder="Violation ID">
                </div>
                </div>

                <div class="form1-row"><!--second row-->
                  <div class="form1-group"><!--column 1-->
                    <input class="textType" type="text" name="studentNumber" id="sanStudentNumber" placeholder="Student Number">
                  </div>
                  <div class="form1-group"><!--column 2-->
                    <input class="textType" type="text" name="studentName" id="sanStudentName" placeholder="Student Name">
                  </div>
                </div>
                <div class="form1-row"><!--third row-->
                  <div class="form1-group"><!--column 1-->
                  <select class="textType" name="violationCase" id="sanViolationCase" value=" ">
                    <option value="">Violation Case</option>
                  </select>
                  </div>
                </div>  
                <div class="form1-row"><!--third row-->
                  <div class="form1-group"><!--column 1-->
                  <select class="textType" name="status" id="sanStatus" value=" ">
                      <option value="">Status</option>
                      <option value="0">Resolve</option>
                      <option value="1">Unresolve</option>
                  </select>
                  </div>
                  <div class="form1-group"><!--column 2-->
                    <select class="textType" name="sanction" id="sanSanction" value=" ">
                        <option value="">Sanction</option>
                        <option value="Verbal Warning">Verbal Warning</option>
                        <option value="Written Reprimand">Written Reprimand</option>
                        <option value="community Service">community Service</option>
                        <option value="suspension">suspension</option>
                        <option value="Non-readmisson">Non-readmisson</option>
                    </select>
                  </div>
                </div>  
                
                <button type="submit" id="searchbtn" class="searchbutton">Search</button>  
              </form>
              
            </div>
            
          </div>
          <!--date filter-->
        <div class="user-box first-box" style="--delay: .6s">
            <!--searching violations-->
            <div class="form-container">
            <p>Date Filter</p>
                <form class="form2" id="searchForm">
                    <div class="form2-row"><!--first row-->
                        <div class="form2-group"><!--column 1-->
                          <!-- Date Search -->
                          <input class="textType" type="date" name="searchSanDate" id="searchSanDate" placeholder="Date">
                          </div>
                    </div>
                      -
                    <div class="form2-row"><!--second row-->
                        <div class="form2-group"><!--column 1-->
                          <!--Until Date-->
                          <input class="textType" type="date" name="searchSanUntilDate" id="searchSanUntilDate" placeholder="untilDate">
                          </div>
                    </div>
                    <!--Outside element-->
                </form>
            </div>
           
        </div>  
          <!--modal buttons for sanction-->
          <div class="user-box fifth-box">
            <!--button for new sanction-->
            <div class="modalSection" style="--delay: .9s">
            <button class="cards-button button" id="btnSanction"  style="--delay: .8s">Set Sanction</button>
            <button class="cards-button button" id="btnUpdateSanction"  style="--delay: .8s">Update Sanction</button>
            <button class="cards-button button" id="exportSanction" style="--delay: .7s">Export as Excel</button>
            <button class="cards-button button" id="exportPDFSanctions" style="--delay: .7s">Print or export as PDF</button>

            </div>
             <!-- The Modal Register Violation -->
             <div id="modalSanction" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                  <!--Adding Violations-->
                  <label>Submit Sanction</label>
                  <div class="form-container">
                    <form class="formModal" action="../JAVASCRIPT/DODeskRecordsJS.js" enctype="multipart/form-data" method="POST" id="addSanctionform">
                        <div class="formModal-row">
                          <div class="formModal-group">
                            <input type="text" placeholder="Violation ID" id="sanSearchViolationID">
                          </div>
                        </div>
                        <div class="formModal-row">
                          <div class="formModal-group">
                            <select name="Sanction" id="sanSearchSanction" value=" ">
                            </select>
                          </div>
                        </div>
                        <div class="formModal-row">
                          <div class="formModal-group">
                            <input type="text" placeholder="Notes example: 3 days suspension" id="sanSanctionNote">
                          </div>
                        </div>
                        <div class="formModal-row">
                          <div class="formModal-group">
                            <input class="modalBtn" type="submit" value="Set Sanction" name="submit">
                          </div>
                        </div>
                        
                        <p style="font-weight: bold;">Batch Sanction</p>
                        <input id="sanctionExcel" type="file" accept=".xlsx, .xls">
                        <input id="submitSanctionExcel" class="modalBtn" type="button" value="Submit Sanction Excel">
                    </form>
                  </div>
                    
                </div>
            </div>

    <!--UPDATE SANCTION-->
            
             <!-- The Modal Register Violation -->
             <div id="modalUpdateSanction" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                  <span class="close">&times;</span>
                  <!--Adding Violations-->
                  <label>Update Sanction</label>
                  <div class="form-container">
                    <form class="formModal" action="../JAVASCRIPT/DODeskRecordsJS.js" enctype="multipart/form-data" method="POST" id="updateSanctionform">
                      <div class="formModal-row">
                        <div class="formModal-group">
                          <select name="sanctionID" id="sanctionID" value=" ">
                          </select>
                        </div>
                      </div>
                      <div class="formModal-row">
                        <div class="formModal-group">
                          <select name="sanctionStatus" id="sanctionStatus" value="">
                                <option value="0">Resolve</option>
                                <option value="1">Unresolve</option>
                            </select>
                        </div>
                      </div>
                      <div class="formModal-row">
                        <div class="formModal-group">
                          <input class="modalBtn" type="submit" value="Set Sanction" name="submit">
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
          <div class="user-box Sixth-box">
               <!--List Module-->
          <div class="cards-wrapper" style="--delay: .9s">
            <div class="cards-header">
              <div class="cards-view">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar">
                <rect x="3" y="4" width="16" height="16" rx="2" ry="2" />
                <path d="M16 2v4M8 2v4M3 10h18" />
                </svg>
                
                <span style="font-weigth: bold;"class="today"> Sanction List</span>
              </div>
            </div>

            <div class="cards card">
              <div id="divSanctiontbl">
              <table class="table" id="sanctionTable">
                <thead>
                <tr>
                  <th>Sanction ID</th>
                  <th>Record By</th>
                  <th>Student number</th>
                  <th>Student name</th>
                  <th>Violation ID</th>
                  <th>Violation Case</th>
                  <th>Sanction</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th>Notes</th>
                  <th>Handled by</th>
                </tr>
                </thead>

                <tbody id="sanctionListRows">
                </tbody>
              </table>
              </div>
            </div>

            </div>

          <!--end fifth-box-->
          </div>
          <br><br><br>
       <!--end wrapper-->
    </div>
     <!-- Snackbar element -->
  <div id="snackbar"></div>
        
        
  <script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>
        <script src="../JAVASCRIPT/DODeskRecordsJS.js"></script>
</body>
</html>