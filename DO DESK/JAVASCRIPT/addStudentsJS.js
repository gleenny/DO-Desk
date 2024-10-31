const url = "../PHP/setStudents.php";
const searchForm = document.querySelector("#searchForm");
const studentForm = document.querySelector("#myformStudent");
const parentForm = document.querySelector("#myformParent");
const pairingForm = document.querySelector("#myformPairing");
const studentExcelUpload = document.querySelector("#submitStudentExcel");
const parentExcelUpload = document.querySelector("#submitParentExcel");
const pairingExcelUpload = document.querySelector("#submitStudentParentExcel");

var modal1 = document.getElementById("modalStudent");
var modal2 = document.getElementById("modalParent");
var modal3 = document.getElementById("modalPairing");
var btn1 = document.getElementById("btnStudent");
var btn2 = document.getElementById("btnParent");
var btn3 = document.getElementById("btnPairing");
var span1 = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[0];
var span3 = document.getElementsByClassName("close")[0];

let studRowCount;

btn1.onclick = function() {
    modal1.style.display = "block";
}
btn2.onclick = function() {
    modal2.style.display = "block";
}
btn3.onclick = function() {
    modal3.style.display = "block";
}
span1.onclick = function() {
    modal1.style.display = "none";
}
span2.onclick = function() {
    modal2.style.display = "none";
}
span3.onclick = function() {
    modal3.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal1) {
      modal1.style.display = "none";
    }
    if (event.target == modal2) {
        modal2.style.display = "none";
    }
    if (event.target == modal3) {
        modal3.style.display = "none";
    }
}

getStudentInfo();



//student batch
studentExcelUpload.addEventListener('click', (e) => {
    e.preventDefault()

    const input = document.getElementById("studentExcel");
    readXlsxFile(input.files[0]).then(function (data) {
        const headers = data[0];
        const jsonData = [];
        for (let i = 1; i < data.length; i++) {
            const temp = {};
            for (let j = 0; j < headers.length; j++) {
                temp[headers[j]] = data[i][j];
            }
            jsonData.push(temp);
        }
        for(i = 0; i < jsonData.length; i++){
            const formData = new FormData();
    
            formData.append("studentNumber", jsonData[i]["Student Number"]);
            formData.append("firstName", jsonData[i]["First Name"]);
            formData.append("middleName", jsonData[i]["Middle Name"]);   
            formData.append("lastName", jsonData[i]["Last Name"]);
            formData.append("course", jsonData[i]["Course"]);
            formData.append("active", jsonData[i]["Active"]);
    
            formData.append("requestType", "Students");
            
            uploadStudents(formData);
        }
    }); 
})

//parent batch
parentExcelUpload.addEventListener('click', (e) => {
    e.preventDefault()

    const input = document.getElementById("parentExcel");
    readXlsxFile(input.files[0]).then(function (data) {
        const headers = data[0];
        const jsonData = [];
        for (let i = 1; i < data.length; i++) {
            const temp = {};
            for (let j = 0; j < headers.length; j++) {
                temp[headers[j]] = data[i][j];
            }
            jsonData.push(temp); 
        }
        for(i = 0; i < jsonData.length; i++){
            const formData = new FormData();
    
            formData.append("firstName", jsonData[i]["First Name"]);
            formData.append("middleName", jsonData[i]["Middle Name"]);    
            formData.append("lastName", jsonData[i]["Last Name"]);
            formData.append("mobileNumber", jsonData[i]["Mobile Number"]);
    
            formData.append("requestType", "Parents");
            
            uploadParents(formData);
        }
    });
})
//pairing batch
pairingExcelUpload.addEventListener('click', (e) => {
    e.preventDefault()

    const input = document.getElementById("studentParentExcel");
    readXlsxFile(input.files[0]).then(function (data) {
        const headers = data[0];
        const jsonData = [];
        for (let i = 1; i < data.length; i++) {
            const temp = {};
            for (let j = 0; j < headers.length; j++) {
                temp[headers[j]] = data[i][j];
            }
            jsonData.push(temp); 
        }
        for(i = 0; i < jsonData.length; i++){
            const formData = new FormData();
    
            formData.append("studentNumberPair", jsonData[i]["Student Number"]);
            formData.append("parentNumberPair", jsonData[i]["Parent ID"]);    
    
            formData.append("requestType", "Pairing");
            
            uploadParents(formData);
        }
    });
})

//adding student
studentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData();

    formData.append("studentNumber", document.querySelector("#studentNumber").value);
    formData.append("firstName", document.querySelector("#studentfirstName").value);
    formData.append("middleName", document.querySelector("#studentMiddleName").value);
    formData.append("lastName", document.querySelector("#studentLastName").value);
    formData.append("course", document.querySelector("#course").value);
    formData.append("active", "1");

    formData.append("requestType", "Students");

    uploadStudents(formData);
})

//uploading students
function uploadStudents(formData){
    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
    })
}

//adding parents
parentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData();

    formData.append("firstName", document.querySelector("#parentfirstName").value);
    formData.append("middleName", document.querySelector("#parentMiddleName").value);
    formData.append("lastName", document.querySelector("#parentLastName").value);
    formData.append("mobileNumber", document.querySelector("#mobileNumber").value);
    formData.append("requestType", "Parents");

    uploadParents(formData);
})

//upload parents
function uploadParents(formData){
    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
    })
}

//pairing
pairingForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData();

    formData.append("studentNumberPair", document.querySelector("#studentNumberPair").value);
    formData.append("parentNumberPair", document.querySelector("#parentNumberPair").value);
    formData.append("requestType", "Pairing");

    uploadPairing(formData);
})

//upload pairing
function uploadPairing(formData){
    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
        console.log("Student has been paired with parent")
    })
}

//searcing students 
searchForm.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    const formData = new FormData();

    formData.append("searchNumber", document.querySelector("#searchNumber").value);
    formData.append("searchName", document.querySelector("#searchName").value);
    formData.append("course", document.querySelector("#searchCourse").value);
    formData.append("status", document.querySelector("#status").value);

    formData.append("requestType", "searchStudent");
    
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

            studRowCount = json["studentNumber"].length;
    
            for(let i = 0; i <= studRowCount - 1; i++){
                populateTable(i, json);
            }
        })
        .catch(error => {
            console.log("An error occure: " + error);
            getStudentInfo();
        })
});

function getStudentInfo(){
    fetch(url, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        console.log("Displaying Student Info")    
        studRowCount = json["studentNumber"].length;
        for(let i = 0; i <= studRowCount - 1; i++){
            populateTable(i, json);
        }
    })
}

function resetTable(){
    for(let i = 0; i <= studRowCount - 1; i++){
        document.querySelector("#studentListRows").deleteRow(0);
    }
}

function populateTable(i, json){
    let tableRow = document.createElement('tr');
            tableRow.id = 'studentList' + i;
    
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
       
            if(json["active"][i] == "1"){
                resolveHolder = "Enrolled"
            }
            else{
                resolveHolder = "Not Enrolled"
            } 
            let status = document.createElement('td');
            status.id = 'status' + i;


            document.querySelector('#studentListRows').appendChild(tableRow);//tbody

            document.querySelector('#studentList' + i).appendChild(studentNumber);
                document.querySelector('#studentNumber' + i).innerHTML = json["studentNumber"][i];

            document.querySelector('#studentList' + i).appendChild(studentName);
                document.querySelector('#studentName' + i).innerHTML = studentNameHolder;

            document.querySelector('#studentList' + i).appendChild(course);
                document.querySelector('#course' + i).innerHTML = json["course"][i];

            document.querySelector('#studentList' + i).appendChild(status);
                document.querySelector('#status' + i).innerHTML = resolveHolder;
}
document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});