const url = "../PHP/students.php";
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
getParentInfo();
getCourses();
getStudentID();
getParentID()
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
function uploadStudents(formData){
    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        showSnackbar(body);
        getStudentInfo();
    })
}
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
function uploadParents(formData){
    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        showSnackbar(body);
        getParentInfo();
    })
}
pairingForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append("studentNumberPair", document.querySelector("#studentNumberPair").value);
    formData.append("parentNumberPair", document.querySelector("#parentNumberPair").value);
    formData.append("requestType", "Pairing");
    uploadPairing(formData);
})
function uploadPairing(formData){
    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        showSnackbar(body);
        console.log("Student has been paired with parent")
        getParentInfo();
        getStudentInfo();
    })
}
searchForm.addEventListener('submit', function (e) {
    e.preventDefault();
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
        document.querySelector("#studentListRows").innerHTML = "";
        if(Object.keys(json).length == 0){
            showSnackbar("No data match");
            getStudentInfo();
        }else{
            for(let i = 0; i < json["studentNumber"].length; i++){
                populateTable(i, json);
            }
            showSnackbar("data has been displayed")
        }
        searchParent(formData);
    })
    .catch(error => {
        console.log(error);
        showSnackbar("Table refresh")
        getStudentInfo();
        getParentInfo();
    })
});
function searchParent(formData){
    formData.set("requestType", "searchParent");
    fetch(url, {
        method: 'POST',
        body: formData,
    })
    .then((Response) => Response.json())
    .then((json) => {
        document.querySelector("#parentListRows").innerHTML = '';
        if(Object.keys(json).length == 0){
            showSnackbar("No parent found");
        }else{
            for(let i = 0; i < json["parentID"].length; i++){
                populateParentTable(i, json);
            }
            showSnackbar("data has been displayed")
        }
    })
    .catch(error => {
        console.log("An error occured: " + error);
    })
}
function getStudentInfo(){
    document.querySelector("#studentListRows").innerHTML = "";
    fetch(url, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        for(let i = 0; i < json["studentNumber"].length; i++){
            populateTable(i, json);
        }
    })
}
function getParentInfo(){
    const formData = new FormData();
    formData.append("requestType", "getParents")
    fetch(url, {
        method: 'POST',
        body:formData
    }).then((Response) => Response.json())
    .then((json) => {
        for(let i = 0; i < json["parentID"].length; i++){
            populateParentTable(i, json);
        }
    })
}
function getCourses(){
    const formData = new FormData();
    formData.append("requestType", "getCourses")
    fetch(url, {
        method: 'POST',
        body:formData
    }).then((Response) => Response.json())
    .then((json) => {   
        for(let i = 0; i < json["courses"].length ; i++){
            let opt = document.createElement('option');
            opt.text = json["courses"][i]
            opt.value = json["courses"][i]
            document.querySelector('#searchCourse').options.add(opt);
        }
        for(let i = 0; i < json["courses"].length ; i++){
            let opt = document.createElement('option');
            opt.text = json["courses"][i]
            opt.value = json["courses"][i]
            document.querySelector('#course').options.add(opt);
        }
    })
}
function getStudentID(){
    const formData = new FormData();
    formData.append("requestType", "getStudentID")
    fetch(url, {
        method: 'POST',
        body:formData
    }).then((Response) => Response.json())
    .then((json) => {   
        for(let i = 0; i < json["studentNumber"].length ; i++){
            let opt = document.createElement('option');
            opt.text = json["studentNumber"][i]
            opt.value = json["studentNumber"][i]
            document.querySelector('#studentNumberPair').options.add(opt);
        }
    })
}
function getParentID(){
    const formData = new FormData();
    formData.append("requestType", "getParentID")
    fetch(url, {
        method: 'POST',
        body:formData
    }).then((Response) => Response.json())
    .then((json) => {   
        for(let i = 0; i < json["parentID"].length ; i++){
            let opt = document.createElement('option');
            opt.text = json["parentID"][i]
            opt.value = json["parentID"][i]
            document.querySelector('#parentNumberPair').options.add(opt);
        }
    })
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
function populateParentTable(i, json){
    let tableRow = document.createElement('tr');
        tableRow.id = 'parentList' + i;
        let parentID = document.createElement('td');
            parentID.id = 'parentID' + i;
        if(json["middleName"][i] == null){
            parentNameHolder = json["firstName"][i] + " " + json["lastName"][i];
        }
        else{
            parentNameHolder = json["firstName"][i] + " " + json["middleName"][i] + " " + json["lastName"][i];
        }  
        let parentName = document.createElement('td');
            parentName.id = 'parentName' + i;
        let mobileNumber = document.createElement('td');
            mobileNumber.id = 'mobileNumber' + i;
        if(json["studentMiddle"][i] == null){
            childNameHolder = json["studentFirst"][i] + " " + json["studentLast"][i];
        }
        else{
            childNameHolder = json["studentFirst"][i] + " " + json["studentMiddle"][i] + " " + json["studentLast"][i];
        } 
        let child = document.createElement('td');
        child.id = 'child' + i;
        document.querySelector('#parentListRows').appendChild(tableRow);//tbody
            document.querySelector('#parentList' + i).appendChild(parentID);
                document.querySelector('#parentID' + i).innerHTML = json["parentID"][i];
            document.querySelector('#parentList' + i).appendChild(parentName);
                document.querySelector('#parentName' + i).innerHTML = parentNameHolder;
            document.querySelector('#parentList' + i).appendChild(mobileNumber);
                document.querySelector('#mobileNumber' + i).innerHTML = json["mobileNumber"][i];
            document.querySelector('#parentList' + i).appendChild(child);
                document.querySelector('#child' + i).innerHTML = childNameHolder;
}
document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});
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
  