const violationurl = "../PHP/violations.php";
const messageurl = "../PHP/semaphoreAPI.php";
const sanctionurl = "../PHP/sanction.php";
const form = document.querySelector('#myform');
const searchForm = document.getElementById('searchForm');
const updateStatusForm = document.querySelector('#updateStatusForm');
const messageParentsForm = document.querySelector('#myformMessage');
const notifyParentForm = document.querySelector('#myNotifyForm');
const searchSanction = document.querySelector('#searchSanctionForm');
const addSanction = document.querySelector('#addSanctionform');
const updateSanction = document.querySelector('#updateSanctionform');

let rowCount = 0;
let rowCountMinor = 0;
let rowMinorReset = 0;
let studentViolator;
getViolationInfo();

let sanRowCount = 0;
getSanctionInfo();

let studentNameHolderSMS

// Get the modal
var modal = document.getElementById('id01');
window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }

var modal1 = document.getElementById("modalSubmit");
var modal2 = document.getElementById("modalUpdate");
var modal3 = document.getElementById("modalMessage");
var modal4 = document.getElementById("modalSendMessage");
var modal5 = document.getElementById("modalSanction");
var modal6 = document.getElementById("modalUpdateSanction");


// Get the button that opens the modal
var btn1 = document.getElementById("btnSubmit");
var btn2 = document.getElementById("btnUpdate");
var btn3 = document.getElementById("submitViolation");
var btn4 = document.getElementById("sendMessage");
var btn5 = document.getElementById("btnSanction");
var btn6 = document.getElementById("btnUpdateSanction");


// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[0];
var span3 = document.getElementsByClassName("close")[0];
var span4 = document.getElementsByClassName("close")[0];
var span5 = document.getElementsByClassName("close")[0];
var span6 = document.getElementsByClassName("close")[0];


// When the user clicks on the button, open the modal
btn1.onclick = function() {
    modal1.style.display = "block";
}
btn2.onclick = function() {
    modal2.style.display = "block";
}
btn4.onclick = function() {
    modal4.style.display = "block";
    document.querySelector('#studentNameSMS').innerHTML = studentNameHolderSMS;
    document.querySelector('#studentNumberSMS').innerHTML = studentViolator;
}
btn5.onclick = function() {
    modal5.style.display = "block";
}
btn6.onclick = function() {
    modal6.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
    modal1.style.display = "none";
}
span2.onclick = function() {
    modal2.style.display = "none";
}
span3.onclick = function() {
    modal3.style.display = "none";
}
span3.onclick = function() {
    modal4.style.display = "none";
}
span5.onclick = function() {
    modal5.style.display = "none";
}
span6.onclick = function() {
    modal6.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
  else if (event.target == modal2) {
    modal2.style.display = "none";
  }
  else if (event.target == modal3) {
    modal3.style.display = "none";
  }
  else if (event.target == modal4) {
    modal4.style.display = "none";
  }
    else if (event.target == modal5) {
    modal5.style.display = "none";
  }
  else if (event.target == modal6) {
    modal6.style.display = "none";
  }
}
//Update sanction
updateSanction.addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData();

    formData.append("sanctionID", document.querySelector("#sanctionID").value);
    formData.append("sanctionStatus", document.querySelector("#sanctionStatus").value);

    formData.append("requestType", "updateSanction");

    fetch(sanctionurl, {
        method: 'POST',
        body: formData
    }).then((Response) =>{
        return Response.text()
    }).then((body) => {
        console.log(body);
        console.log("Resetting table");
        sanResetTable();
        console.log("Repopulating table");
        getSanctionInfo();
    })
});
//send message to parents
messageParentsForm.addEventListener('submit', (e) => {
    e.preventDefault();

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;

    if(document.querySelector('#schedDate').value > today){
        const formData = new FormData();

        formData.append("studentNumber", studentViolator);
        formData.append("message", document.querySelector("#messageText").value);
        formData.append("date", document.querySelector("#schedDate").value);

        formData.append("requestType", "sendMessage");

        fetch(messageurl, {
            method: 'POST',
            body: formData
        }).then((Response) => {
            return Response.text()
        }).then((body) => {
            console.log(body)
            console.log("Message was succesfully sent to the student's parent")
        }).catch(error => {
            console.log("An error occure: " + error);
        })
    }else{
        console.log("selected date is invalid");
    }
})

//adding new violations
form.addEventListener('submit', (e) => {
    e.preventDefault()

    const formData = new FormData();

    formData.append("violationCase", document.querySelector("#violationCase").value);
    formData.append("studentNumber", document.querySelector("#studentNumber").value);

    formData.append("requestType", "addViolation");

    fetch(violationurl, {
        method: 'POST',
        body: formData,
    }).then((Response) => Response.json())
    .then((json) => {
        console.log(json)
        console.log("Data has been added");
        console.log("Resetting table"); 
        resetTable();
        console.log("Repopulating table"); 
        getViolationInfo();
        console.log("hello")
        if(json["type"][0] == "Minor"){
            console.log(json["type"])
            checkMinorViolationCount();
        }
    })
});

//searching student violations
searchForm.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    const formData = new FormData();

    formData.append("studentNumber", document.querySelector("#searchNumber").value);
    formData.append("studentName", document.querySelector("#searchName").value);
    formData.append("course", document.querySelector("#searchCourse").value);
    formData.append("violationType", document.querySelector("#typeOfViolation").value);
    formData.append("violationCase", document.querySelector("#searchCase").value);
    formData.append("status", document.querySelector("#status").value);
    formData.append("date", document.querySelector("#searchDate").value);

    formData.append("requestType", "SearchStudentViolation");
    
        fetch(violationurl, {
            method: 'POST',
            body: formData,
        })
        .then((Response) => Response.json())
        .then((json) => {
            // Handle and display search results
            console.log("Resetting table"); 
            resetTable();
            console.log(json);
            console.log("Repopulating table"); 
            console.log("Displaying list of violation cases") 

            rowCount = json["violationID"].length;
    
            for(let i = 0; i <= rowCount - 1; i++){
                populateTable(i, json);
            }
        })
        .catch(error => {
            console.log("An error occure: " + error);
            getViolationInfo();
        })
});

//updating the case status
updateStatusForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData();

    formData.append("violationID", document.querySelector("#violationID").value);
    formData.append("violationStatus", document.querySelector("#violationStatus").value);

    formData.append("requestType", "updateStatus");

    fetch(violationurl, {
        method: 'POST',
        body: formData
    }).then((Response) =>{
        return Response.text()
    }).then((body) => {
        console.log(body);
        console.log("Violation case has been updated");
        console.log("Resetting table");
        resetTable();
        console.log("Repopulating table");
        getViolationInfo();
    })
});

//checking 3 minor violations
function checkMinorViolationCount(){
    const formData = new FormData();

    formData.append("studentNumber", document.querySelector("#studentNumber").value);

    formData.append("requestType", "checkMinorViolationCount");

    fetch(violationurl, {
        method: 'POST',
        body: formData
    }).then((Response) =>  Response.json())
    .then((json) => {
        rowCountMinor = json["violationID"].length;
        studentNameHolderSMS = json["firstName"][0];
        if((rowCountMinor % 3) == 0){
            console.log("reset table")
            for(let i = 0; i < rowMinorReset; i++){
                document.querySelector("#studentViolations").deleteRow(0);
            }
            console.log("populate table")
            for(let i = 0; i < 3; i++){
                let tableRowMinor = document.createElement('tr');
                tableRowMinor.id = 'violationListMinor' + i;
            
                let violationIDMinor = document.createElement('td');
                violationIDMinor.id = 'violationIDMinor' + i;
    
                let violationTypeMinor = document.createElement('td');
                violationTypeMinor.id = 'violationTypeMinor' + i;
    
                let violationCaseMinor = document.createElement('td');
                violationCaseMinor.id = 'violationCaseMinor' + i;
    
                if(json["active"][i] == 1){
                    resolveHolder = "Unresolved"
                }
                else{
                    resolveHolder = "Resolved"
                }  
                let activeMinor = document.createElement('td');
                activeMinor.id = 'activeMinor' + i;
    
                let violationDateMinor = document.createElement('td');
                violationDateMinor.id = 'violationDateMinor' + i;
    
                document.querySelector('#studentViolations').appendChild(tableRowMinor);//tbody
    
                document.querySelector('#violationListMinor' + i).appendChild(violationIDMinor);
                    document.querySelector('#violationIDMinor' + i).innerHTML = json["violationID"][i];
                
                document.querySelector('#violationListMinor' + i).appendChild(violationTypeMinor);
                    document.querySelector('#violationTypeMinor' + i).innerHTML = json["violationType"][i];
    
                document.querySelector('#violationListMinor' + i).appendChild(violationCaseMinor);
                    document.querySelector('#violationCaseMinor' + i).innerHTML = json["violationCase"][i];
    
                document.querySelector('#violationListMinor' + i).appendChild(activeMinor);
                    document.querySelector('#activeMinor' + i).innerHTML = resolveHolder;
    
                document.querySelector('#violationListMinor' + i).appendChild(violationDateMinor);
                    document.querySelector('#violationDateMinor' + i).innerHTML = json["violationDate"][i];
            } 
            rowMinorReset = 3;
            document.querySelector('#messageParent').innerHTML = json["firstName"][0] + "'s minor violations";
            studentViolator = json["studentNumber"][0];
            modal3.style.display = "block";
        }
    })
}

//report list of student violations
function getViolationInfo(){
    fetch(violationurl, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        console.log("Displaying list of violation cases")    
        rowCount = json["violationID"].length;
        for(let i = 0; i <= rowCount - 1; i++){
            populateTable(i, json);
        }
    })
}

function resetTable(){
    for(let i = 0; i <= rowCount - 1; i++){
        document.querySelector("#reportListRows").deleteRow(0);
    }
}
function populateTable(i, json){
    let tableRow = document.createElement('tr');
            tableRow.id = 'violationList' + i;
        
            let violationID = document.createElement('td');
            violationID.id = 'violationID' + i;

            let doName = document.createElement('td');
            doName.id = 'doName' + i;

            let studentNumber = document.createElement('td');
            studentNumber.id = 'studentNumber' + i;

            if(json["middleName"][i] == null){
                studentNameHolder = json["firstName"][i] + " " + json["lastName"][i];
            }
            else{
                studentNameHolder = json["firstName"][i] + " " + json["middleName"][i] + " " + json["lastName"][i];
            }  

            let studentName = document.createElement('td');
            studentName.id = 'studentName' + i;

            let course = document.createElement('td');
            course.id = 'course' + i;

            let violationType = document.createElement('td');
            violationType.id = 'violationType' + i;

            let violationCase = document.createElement('td');
            violationCase.id = 'violationCase' + i;

            if(json["active"][i] == 1){
                resolveHolder = "Unresolved"
            }
            else{
                resolveHolder = "Resolved"
            }  
            let active = document.createElement('td');
            active.id = 'active' + i;

            let violationDate = document.createElement('td');
            violationDate.id = 'violationDate' + i;


            document.querySelector('#reportListRows').appendChild(tableRow);//tbody

            document.querySelector('#violationList' + i).appendChild(violationID);
                document.querySelector('#violationID' + i).innerHTML = json["violationID"][i];
            
            document.querySelector('#violationList' + i).appendChild(doName);
                document.querySelector('#doName' + i).innerHTML = json["doFirst"][i] + " " + json["doLast"][i];

            document.querySelector('#violationList' + i).appendChild(studentNumber);
                document.querySelector('#studentNumber' + i).innerHTML = json["studentNumber"][i];

            document.querySelector('#violationList' + i).appendChild(studentName);
                document.querySelector('#studentName' + i).innerHTML = studentNameHolder;

            document.querySelector('#violationList' + i).appendChild(course);
                document.querySelector('#course' + i).innerHTML = json["course"][i];

            document.querySelector('#violationList' + i).appendChild(violationType);
                document.querySelector('#violationType' + i).innerHTML = json["violationType"][i];

            document.querySelector('#violationList' + i).appendChild(violationCase);
                document.querySelector('#violationCase' + i).innerHTML = json["violationCase"][i];

            document.querySelector('#violationList' + i).appendChild(active);
                document.querySelector('#active' + i).innerHTML = resolveHolder;

            document.querySelector('#violationList' + i).appendChild(violationDate);
                document.querySelector('#violationDate' + i).innerHTML = json["violationDate"][i];
}

document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});

//SANCTIONS
//search sanction
searchSanction.addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData();

    formData.append("sanctionID", document.querySelector("#sanSanctionID").value);
    formData.append("studentNumber", document.querySelector("#sanStudentNumber").value);
    formData.append("studentName", document.querySelector("#sanStudentName").value);
    formData.append("violationID", document.querySelector("#sanViolationID").value);
    formData.append("violationCase", document.querySelector("#sanViolationCase").value);
    formData.append("sanction", document.querySelector("#sanSanction").value);
    formData.append("status", document.querySelector("#sanStatus").value);

    formData.append("requestType", "searchSanction");

    fetch(sanctionurl, {
        method: 'POST',
        body: formData,
    })
    .then((Response) => Response.json())
    .then((json) => {
        // Handle and display search results
        console.log("Resetting table"); 
        sanResetTable();
        console.log(json);
        console.log("Repopulating table"); 
        console.log("Displaying list of sanctions") 

        sanRowCount = json["sanctionID"].length;

        for(let i = 0; i <= sanRowCount - 1; i++){
            populateSanctionTable(i, json);
        }
    })
    .catch(error => {
        console.log("An error occure: " + error);
        getSanctionInfo();
    })
})
//adding sanction
addSanction.addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData();

    formData.append("violationID", document.querySelector("#sanSearchViolationID").value);
    formData.append("sanction", document.querySelector("#sanSearchSanction").value);

    formData.append("requestType", "addSanction");

    fetch(sanctionurl, {
        method:'POST',
        body:formData
    }).then((Response) => {
        Response.text()
    }).then((body) => {
        console.log(body);
        console.log("Resetting table");
        sanResetTable();
        console.log("Repopulating table");
        getSanctionInfo();
    })
})

function getSanctionInfo(){
    fetch(sanctionurl, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        console.log("Displaying list of sanctions")  
        sanRowCount = json["sanctionID"].length;
        for(let i = 0; i <= sanRowCount - 1; i++){
            populateSanctionTable(i, json);
        }
    })
}
function sanResetTable(){
    for(let i = 0; i <= sanRowCount - 1; i++){
        document.querySelector("#sanctionListRows").deleteRow(0);
    }
}
function populateSanctionTable(i, json){
    let tableRow = document.createElement('tr');
            tableRow.id = 'sanctionList' + i;
        
            let sanSanctionID = document.createElement('td');
            sanSanctionID.id = 'sanSanctionID' + i;

            let sanRecordedBy = document.createElement('td');
            sanRecordedBy.id = 'sanRecordedBy' + i;

            let sanStudentNumber = document.createElement('td');
            sanStudentNumber.id = 'sanStudentNumber' + i;

            if(json["studentMiddle"][i] == null){
                sanStudentNameHolder = json["studentFirst"][i] + " " + json["studentLast"][i];
            }
            else{
                sanStudentNameHolder = json["studentFirst"][i] + " " + json["studentMiddle"][i] + " " + json["studentLast"][i];
            }  

            let sanStudentName = document.createElement('td');
            sanStudentName.id = 'sanStudentName' + i;

            let sanViolationId = document.createElement('td');
            sanViolationId.id = 'sanViolationId' + i;

            let sanViolationCase = document.createElement('td');
            sanViolationCase.id = 'sanViolationCase' + i;

            let sanSanction = document.createElement('td');
            sanSanction.id = 'sanSanction' + i;

            if(json["status"][i] == 1){
                sanResolveHolder = "Unresolved"
            }
            else{
                sanResolveHolder = "Resolved"
            }  
            let sanStatus = document.createElement('td');
            sanStatus.id = 'sanStatus' + i;

            let sanDate = document.createElement('td');
            sanDate.id = 'sanDate' + i;

            document.querySelector('#sanctionListRows').appendChild(tableRow);//tbody

            document.querySelector('#sanctionList' + i).appendChild(sanSanctionID);
                document.querySelector('#sanSanctionID' + i).innerHTML = json["sanctionID"][i];
            
            document.querySelector('#sanctionList' + i).appendChild(sanRecordedBy);
                document.querySelector('#sanRecordedBy' + i).innerHTML = json["firstName"][i] = json['lastName'][i];

            document.querySelector('#sanctionList' + i).appendChild(sanStudentNumber);
                document.querySelector('#sanStudentNumber' + i).innerHTML = json["studentNumber"][i];

            document.querySelector('#sanctionList' + i).appendChild(sanStudentName);
                document.querySelector('#sanStudentName' + i).innerHTML = sanStudentNameHolder;

            document.querySelector('#sanctionList' + i).appendChild(sanViolationId);
                document.querySelector('#sanViolationId' + i).innerHTML = json["violationID"][i];

            document.querySelector('#sanctionList' + i).appendChild(sanViolationCase);
                document.querySelector('#sanViolationCase' + i).innerHTML = json["violationCase"][i];

            document.querySelector('#sanctionList' + i).appendChild(sanSanction);
                document.querySelector('#sanSanction' + i).innerHTML = json["sanction"][i];

            document.querySelector('#sanctionList' + i).appendChild(sanStatus);
                document.querySelector('#sanStatus' + i).innerHTML = sanResolveHolder;

            document.querySelector('#sanctionList' + i).appendChild(sanDate);
                document.querySelector('#sanDate' + i).innerHTML = json["date"][i];
}
// Function to show the snackbar with a custom message
function showSnackbar(message) {
    const snackbar = document.getElementById("snackbar");
    
    // Set the custom message
    snackbar.textContent = message;
  
    // Add the "show" class to make it visible
    snackbar.classList.add("show");
  
    // Remove the "show" class after 3 seconds
    setTimeout(() => {
      snackbar.classList.remove("show");
    }, 3000);
  }
  