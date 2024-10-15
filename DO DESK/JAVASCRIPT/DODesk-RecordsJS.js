const violationurl = "../PHP/violations.php";
const form = document.querySelector('#myform');
const searchForm = document.getElementById('searchForm');
const updateStatusForm = document.querySelector('#updateStatusForm');

let rowCount = 0;
getViolationInfo();

// Get the modal
var modal1 = document.getElementById("modalSubmit");
var modal2 = document.getElementById("modalUpdate");

// Get the button that opens the modal
var btn1 = document.getElementById("btnSubmit");
var btn2 = document.getElementById("btnUpdate");


// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[0];


// When the user clicks on the button, open the modal
btn1.onclick = function() {
  modal1.style.display = "block";
}
btn2.onclick = function() {
    modal2.style.display = "block";
  }

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
  modal1.style.display = "none";
}
span2.onclick = function() {
    modal2.style.display = "none";
  }

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
  else if (event.target == modal2) {
    modal2.style.display = "none";
  }
}


//adding new violations
form.addEventListener('submit', (e) => {
    e.preventDefault()

    const formData = new FormData();

    formData.append("violationType", document.querySelector("#violationType").value);
    formData.append("violationCase", document.querySelector("#violationCase").value);
    formData.append("studentNumber", document.querySelector("#studentNumber").value);

    formData.append("requestType", "addViolation");

    fetch(violationurl, {
        method: 'POST',
        body: formData,
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
        console.log("Data has been added");
        console.log("Resetting table"); 
        resetTable();
        console.log("Repopulating table"); 
        getViolationInfo();
    })
});

//report list of student violations
function getViolationInfo(){
    fetch(violationurl, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        console.log("Displaying list of violation cases")    
        rowCount = json["Officer"].length;
        for(let i = 0; i <= rowCount - 1; i++){
            populateTable(i, json);
        }
    })
}

//report list of student violations
searchForm.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    const formData = new FormData();

    formData.append("studentNumber", document.querySelector("#searchNumber").value);
    formData.append("studentName", document.querySelector("#searchName").value);
    formData.append("course", document.querySelector("#searchCourse").value);
    formData.append("section", document.querySelector("#searchSection").value);
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

            rowCount = json["Officer"].length;
    
            for(let i = 0; i <= rowCount - 1; i++){
                populateTable(i, json);
            }
        })
        .catch(error => {
            console.log("An error occure: " + error);
            getViolationInfo();
        })
});
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

            let section = document.createElement('td');
            section.id = 'section' + i;

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

            document.querySelector('#violationList' + i).appendChild(section);
                document.querySelector('#section' + i).innerHTML = json["section"][i];

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
