const geturl = "../PHP/getViolationsData.php";
const seturl = "../PHP/setViolationData.php";
const searchurl = "../PHP/searchViolationData.php";
const form = document.querySelector('#myform');
const searchForm = document.getElementById('searchForm');


const getsearch = "../PHP/searchViolationData.php";
let rowCount = 0;
let studentCount = 0;
getViolationInfo();
//searchStudents();


//adding new violations
form.addEventListener('submit', (e) => {
    e.preventDefault()

    const formData = new FormData();

    formData.append("violationType", document.querySelector("#violationType").value);
    formData.append("violationCase", document.querySelector("#violationCase").value);
    formData.append("studentNumber", document.querySelector("#studentNumber").value);

    fetch(seturl, {
        method: 'POST',
        body: formData,
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
        console.log("Data has been added");
        console.log("Resetting table"); 
        for(let i = 0; i <= rowCount - 1; i++){
            document.querySelector("#reportListRows").deleteRow(0);
        }
        console.log("Repopulating table"); 
        getViolationInfo();
    })
});

//report list of student violations
function getViolationInfo(){
    fetch(geturl, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        console.log("Displaying list of violation cases") 
        rowCount = json["Officer"].length;

        for(let i = 0; i <= rowCount - 1; i++){

            let tableRow = document.createElement('tr');
            tableRow.id = 'violationList' + i;
        
            let RecordedBy = document.createElement('td');
            RecordedBy.id = 'RecordedBy' + i;

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


            document.querySelector('#reportListRows').appendChild(tableRow);//tbody
            
            document.querySelector('#violationList' + i).appendChild(RecordedBy);
                document.querySelector('#RecordedBy' + i).innerHTML = json["recordedBy"][i];

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
        }

        //document.querySelector('#student').innerHTML = json["studentNumber"][0];
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
    //status
    /*if(document.querySelector("#status").value == "Resolve"){
        formData.append("status", 0);
    }
    else if(document.querySelector("#status").value == "Unresolve"){
        formData.append("status", 1);
    }
    else{
        formData.append("status", '');
    }*/

    formData.append("requestType", "SearchStudentViolation");
    

    fetch(searchurl, {
        method: 'POST',
        body: formData,
    })
    .then((Response) => Response.json())
    .then((json) => {

        console.log(formData.get("studentName"))

        // Handle and display search results
        console.log(json);
        console.log("Resetting table"); 
        for(let i = 0; i <= rowCount - 1; i++){
            document.querySelector("#reportListRows").deleteRow(0);
        }
        console.log("Repopulating table"); 
        console.log("Displaying list of violation cases") 
        rowCount = json["Officer"].length;

        for(let i = 0; i <= rowCount - 1; i++){

            let tableRow = document.createElement('tr');
            tableRow.id = 'violationList' + i;
        
            let RecordedBy = document.createElement('td');
            RecordedBy.id = 'RecordedBy' + i;

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


            document.querySelector('#reportListRows').appendChild(tableRow);//tbody
            
            document.querySelector('#violationList' + i).appendChild(RecordedBy);
                document.querySelector('#RecordedBy' + i).innerHTML = json["recordedBy"][i];

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
        }
    })
});

/*fetch(searchurl, {
    method: 'POST',
    body: formData,
})
.then((Response) => {
return Response.text()
})
.then(json => {
    // Handle and display search results
    const resultContainer = document.getElementById('searchResults');
    resultContainer.innerHTML = '';

    console.log(json);
})*/

/*fetch(searchurl, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(json => {
        // Handle and display search results
        const resultContainer = document.getElementById('searchResults');
        resultContainer.innerHTML = '';

        console.log(json);
    })*/

/* if (json.length > 0) {
            json.forEach(item => {
                resultContainer.innerHTML += `<div>
                    <strong>Student Number:</strong> ${item.studentNumber} <br>
                    <strong>Name:</strong> ${item.studentName} <br>
                    <strong>Course:</strong> ${item.course} <br>
                    <strong>Violation Type:</strong> ${item.ViolationType} <br>
                    <strong>Case:</strong> ${item.ViolationCase} <br>
                    <strong>Status:</strong> ${item.status} <br><hr>
                </div>`;
            });
        } else {
            resultContainer.innerHTML = 'No results found';
        }
    })*/
  /*  .catch(error => {
        // Display error message to user
        const resultContainer = document.getElementById('searchResults');
        resultContainer.innerHTML = 'An error occurred while processing your request. Please try again later.';
        console.error('Error:', error); // Log error to console for debugging purposes
    });*/


/*
// Modal 
//Get the div = modal 
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/














/*function setReportLists(){
    for(let i = 1; i <= reports; i++){
        let tableRow = document.createElement('tr');
        tableRow.id = 'reportList' + i;
    
        let recordedBy = document.createElement('td');
        recordedBy.id = 'recordedBy' + 1;
        let studentNumber = document.createElement('td');
        studentNumber.id = 'studentNumber' + i;
        let lastName = document.createElement('td');
        lastName.id = 'lastName' + i;
        let firstName = document.createElement('td');
        firstName.id = 'firstName' + i;
        let middleName = document.createElement('td');
        middleName.id = 'middleName' + i;
        let course = document.createElement('td');
        course.id = 'course' + i;
        let level = document.createElement('td');
        level.id = 'level' + i;
        let violation = document.createElement('td');
        violation.id = 'violation' + i;
        
        //status
        let status = document.createElement('td');
        status.id = 'status' + i;
        let statusDiv = document.createElement('div');
        statusDiv.id = 'statusDiv' + i;
        statusDiv.classList.add('status');
        if(statusData == 'Done'){
            statusDiv.classList.add('is-green');
        }
        else if(statusData == 'Pending'){
            statusDiv.classList.add('is-red');
        }
        else if(statusData == 'Waiting'){
            statusDiv.classList.add('is-wait');
        }
    
        document.querySelector('#reportListRows').appendChild(tableRow);
        document.querySelector('#reportList' + i).appendChild(recordedBy);
            document.querySelector('#recordedBy' + i).innerHTML = recordedByData;

        document.querySelector('#reportList' + i).appendChild(studentNumber);
            document.querySelector('#studentNumber' + i).innerHTML = studentNumberData;
    
        document.querySelector('#reportList' + i).appendChild(lastName);
            document.querySelector('#lastName' + i).innerHTML = lastNameData;
    
        document.querySelector('#reportList' + i).appendChild(firstName);
            document.querySelector('#firstName' + i).innerHTML = firstNameData;
    
        document.querySelector('#reportList' + i).appendChild(middleName);
            document.querySelector('#middleName' + i).innerHTML = middleNameData;
    
        document.querySelector('#reportList' + i).appendChild(course);
            document.querySelector('#course' + i).innerHTML = courseData;

        document.querySelector('#reportList' + i).appendChild(level);
            document.querySelector('#level' + i).innerHTML = levelData;

        document.querySelector('#reportList' + i).appendChild(violation);
            document.querySelector('#violation' + i).innerHTML = violationData;
    
        document.querySelector('#reportList' + i).appendChild(status);
        document.querySelector('#status' + i).appendChild(statusDiv);
            document.querySelector('#statusDiv' + i).innerHTML = statusData;
    }
}
    */


document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});
