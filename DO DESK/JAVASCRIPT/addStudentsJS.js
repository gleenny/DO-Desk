const url = "../PHP/setStudents.php";
const studentForm = document.querySelector("#myformStudent");
const parentForm = document.querySelector("#myformParent");
const pairingForm = document.querySelector("#myformPairing");

console.log("JS connected");

var modal1 = document.getElementById("modalSubmit");
var btn1 = document.getElementById("btnSubmit");
var span1 = document.getElementsByClassName("close")[0];

btn1.onclick = function() {
    modal1.style.display = "block";
}
span1.onclick = function() {
    modal1.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal1) {
      modal1.style.display = "none";
    }
}

//adding student
studentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData();

    formData.append("studentNumber", document.querySelector("#studentNumber").value);
    formData.append("firstName", document.querySelector("#studentfirstName").value);
    formData.append("middleName", document.querySelector("#studentMiddleName").value);
    formData.append("lastName", document.querySelector("#studentLastName").value);
    formData.append("course", document.querySelector("#course").value);
    formData.append("section", document.querySelector("#section").value);
    formData.append("requestType", "Students");

    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
        console.log("Student has been added to database")
    })
})

//adding parents
parentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData();

    formData.append("firstName", document.querySelector("#parentfirstName").value);
    formData.append("middleName", document.querySelector("#parentMiddleName").value);
    formData.append("lastName", document.querySelector("#parentLastName").value);
    formData.append("mobileNumber", document.querySelector("#mobileNumber").value);
    formData.append("requestType", "Parents");

    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
        console.log("Parent has been added to database")
    })
})

pairingForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData();

    formData.append("studentNumberPair", document.querySelector("#studentNumberPair").value);
    formData.append("parentNumberPair", document.querySelector("#parentNumberPair").value);
    formData.append("requestType", "Pairing");

    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
        console.log("Student has been paired with parent")
    })
})

//report list of student 
searchForm.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    const formData = new FormData();

    formData.append("studentID", document.querySelector("#studentID").value);
    formData.append("studentName", document.querySelector("#searchName").value);
    formData.append("course", document.querySelector("#searchCourse").value);
    formData.append("section", document.querySelector("#searchSection").value);
    formData.append("studentNumber", document.querySelector("#searchNumber").value);
    formData.append("status", document.querySelector("#status").value);

    formData.append("requestType", "SearchStudentViolation");
    
        fetch(url, {
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

function resetTable(){
    for(let i = 0; i <= rowCount - 1; i++){
        document.querySelector("#studentListRows").deleteRow(0);
    }
}
function populateTable(i, json){
    let tableRow = document.createElement('tr');
            tableRow.id = 'studentList' + i;
        
            let violationID = document.createElement('td');
            violationID.id = 'studentID' + i;
    
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
       
            let status = document.createElement('td');
            status.id = 'status' + i;


            document.querySelector('#studentListRows').appendChild(tableRow);//tbody

            document.querySelector('#studentList' + i).appendChild(studentName);
            document.querySelector('#studentID' + i).innerHTML = studentNameHolder;

            document.querySelector('#studentList' + i).appendChild(studentName);
                document.querySelector('#studentName' + i).innerHTML = studentNameHolder;

            document.querySelector('#studentList' + i).appendChild(course);
                document.querySelector('#course' + i).innerHTML = json["course"][i];

            document.querySelector('#studentList' + i).appendChild(section);
                document.querySelector('#section' + i).innerHTML = json["section"][i];

            document.querySelector('#studentList' + i).appendChild(studentNumber);
                document.querySelector('#studentNumber' + i).innerHTML = json["studentNumber"][i];

            document.querySelector('#studentList' + i).appendChild(active);
                document.querySelector('#status' + i).innerHTML = resolveHolder;

           

}