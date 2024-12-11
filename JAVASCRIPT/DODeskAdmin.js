const adminurl = "../PHP/admin.php";
const auditurl = "../PHP/audit.php";
const form = document.querySelector('#myform');
const searchForm = document.getElementById('searchForm');
const searchAudit = document.querySelector('#searchAuditForm');
const updateStatusForm = document.querySelector('#updateStatusForm');
const changePasswordForm = document.querySelector('#changePasswordForm');
const changeUsernameForm = document.querySelector('#changeUsernameForm');
const addNewViolation = document.querySelector('#addNewViolation');

getUserInfo();
getAudit();
getAdminID();

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[0];
var span3 = document.getElementsByClassName("close")[0];
var span3 = document.getElementsByClassName("close")[0];


// Get the modal

        var modal = document.getElementById('modalRegister');
        var modal1 = document.getElementById('modalUpdateStatus');
        var modal2 = document.getElementById('modalChangeUsername');
        var modal3 = document.getElementById('modalChangePassword');



// Get the button that opens the modal
        var btn = document.getElementById("btnRegister");
        var btn1 = document.getElementById("btnUpdateStatus");
        var btn3 = document.getElementById("btnChangePassword");


// Get the <span> element that closes the modal
        var span = modal.getElementsByClassName("close")[0]; // Modified by dsones uk
        var span1 = modal1.getElementsByClassName("close")[0]; // Modified by dsones uk
        var span2 = modal2.getElementsByClassName("close")[0]; // Modified by dsones uk
        var span3 = modal3.getElementsByClassName("close")[0]; // Modified by dsones uk



// When the user clicks on the button, open the modal

        btn.onclick = function() { modal.style.display = "block";}
        btn1.onclick = function() { modal1.style.display = "block";}
        btn3.onclick = function() { modal3.style.display = "block";}



// When the user clicks on <span> (x), close the modal
        span.onclick = function() { modal.style.display = "none"; }
        span1.onclick = function() { modal1.style.display = "none"; }
        span2.onclick = function() { modal2.style.display = "none"; }
        span3.onclick = function() { modal3.style.display = "none"; }


addNewViolation.addEventListener('click', (e) =>{
  e.preventDefault();
  const formData = new FormData();
  formData.append("newViolation", document.querySelector("#newViolation").value);
  formData.append("newViolationType", document.querySelector("#newViolationType").value);
  formData.append("requestType", "addNewViolation");
  fetch(adminurl, {
    method: 'POST',
    body: formData,
  })
  .then((Response) => {
    return Response.text()
  }).then((body) => {
    showSnackbar("New violation has been added")
  }).catch(error => {
    console.log(error)
    showSnackbar("An Error occured");
  })
})
function getAudit(){
  fetch(auditurl, {
      method: 'GET'
  }).then((Response) => Response.json())
  .then((json) => {
      for(let i = 0; i < json["logID"].length; i++){
        populateTableAudit(i, json);
      }
  })
}
searchAudit.addEventListener('submit', function (e){
  e.preventDefault();
  const formData = new FormData();
  formData.append("logID", document.querySelector("#searchAuditLOGID").value);
  formData.append("name", document.querySelector("#searchAuditName").value);
  formData.append("date", document.querySelector("#searchAuditDate").value);
  formData.append("process", document.querySelector("#searchAuditProcess").value);
  formData.append("note", document.querySelector("#searchAuditNote").value);
  formData.append("requestType", "searchAudit");
  fetch(adminurl, {
    method: 'POST',
    body: formData,
  })
  .then((Response) => Response.json())
  .then((json) => {
      document.querySelector("#AuditListRows").innerHTML = '';
      if(Object.keys(json).length == 0){
        showSnackbar("No data match")
        getUserInfo();
      }else{
        for(let i = 0; i < json["logID"].length; i++){
          populateTableAudit(i, json);
        }
        showSnackbar("data has been displayed");
      }
  })
  .catch(error => {
      console.log(error)
      showSnackbar("Table Refresh");
      document.querySelector("#AuditListRows").innerHTML = '';
      getAudit();
  })
})
changeUsernameForm.addEventListener('submit', (e) => {
  e.preventDefault();
  const formData = new FormData();
  formData.append("userID", document.querySelector("#userIDUsername").value);
  formData.append("username", document.querySelector("#changeUsername").value);
  formData.append("requestType", "changeUsername");
  fetch(adminurl, {
    method: 'POST',
    body: formData,
  }).then((Response) => {
      return Response.text()
  }).then((body) => {
      showSnackbar(body)
  })
})
changePasswordForm.addEventListener('submit', (e) => {
  e.preventDefault();
  const formData = new FormData();
  formData.append("userID", document.querySelector("#userIDPassword").value);
  formData.append("password", document.querySelector("#changePassword").value);
  formData.append("requestType", "changePassword");
  fetch(adminurl, {
    method: 'POST',
    body: formData,
  }).then((Response) => {
      return Response.text()
  }).then((body) => {
    showSnackbar(body);
  })
})
form.addEventListener('submit', (e) => {
  e.preventDefault()
  const formData = new FormData();
  formData.append("firstName", document.querySelector("#firstName").value);
  formData.append("middleName", document.querySelector("#middleName").value);
  formData.append("lastName", document.querySelector("#lastName").value);
  formData.append("username", document.querySelector("#username").value);
  formData.append("password", document.querySelector("#password").value);
  formData.append("role", document.querySelector("#role").value);
  formData.append("requestType", "addUser");
  if(document.querySelector("#firstName").value != "" && document.querySelector("#lastName").value != "" &&
   document.querySelector("#username").value != "" && document.querySelector("#password").value != ""){
    fetch(adminurl, {
      method: 'POST',
      body: formData,
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        showSnackbar(body);
        document.querySelector("#userListRows").innerHTML = '';
        getUserInfo();
        document.querySelector('#adminID').innerhtml = '';
        getAdminID();
    })
  }else{
    showSnackbar("missing field");
  }
});
searchForm.addEventListener('submit', function (e) {
  e.preventDefault();
  const formData = new FormData();
    formData.append("userID", document.querySelector("#searchUserID").value);
    formData.append("name", document.querySelector("#searchName").value);
    formData.append("status", document.querySelector("#searchStatus").value);
    formData.append("requestType", "searchUser");
      fetch(adminurl, {
          method: 'POST',
          body: formData,
      })
      .then((Response) => Response.json())
      .then((json) => {
          document.querySelector("#userListRows").innerHTML = '';
          if(Object.keys(json).length == 0){
            showSnackbar("No data match")
            getUserInfo();
          }else{
            for(let i = 0; i < json["userID"].length; i++){
              populateTable(i, json);
            }
            showSnackbar("data has been displayed");
          }
      })
      .catch(error => {
          console.log(error)
          showSnackbar("Table Refresh");
          document.querySelector("#userListRows").innerHTML = '';
          getUserInfo();
      })
});
updateStatusForm.addEventListener('submit', (e) => {
  e.preventDefault();
  const formData = new FormData();
  formData.append("adminID", document.querySelector("#adminID").value);
  formData.append("adminStatus", document.querySelector("#adminStatus").value);
  formData.append("requestType", "updateStatus");
  fetch(adminurl, {
      method: 'POST',
      body: formData
  }).then((Response) =>{}).then((body) => {
      showSnackbar(body);
      document.querySelector("#userListRows").innerHTML = '';
      getUserInfo();
  })
});
function getAdminID(){
  const formData = new FormData();
  formData.append("requestType", "getAdminID")
  fetch(adminurl, {
      method: 'POST',
      body:formData
  }).then((Response) => Response.json())
  .then((json) => {   
      for(let i = 0; i < json["userID"].length ; i++){
          let opt = document.createElement('option');
          opt.text = json["userID"][i]
          opt.value = json["userID"][i]
          document.querySelector('#adminID').options.add(opt);
      }
      for(let i = 0; i < json["userID"].length ; i++){
        let opt = document.createElement('option');
        opt.text = json["userID"][i]
        opt.value = json["userID"][i]
        document.querySelector('#userIDPassword').options.add(opt);
      }
  })
}
function getUserInfo(){
  fetch(adminurl, {
      method: 'GET'
  }).then((Response) => Response.json())
  .then((json) => { 
      for(let i = 0; i < json["userID"].length; i++){
          populateTable(i, json);
      }
  })
}
function populateTable(i, json){
  let tableRow = document.createElement('tr');
    tableRow.id = 'userList' + i;
    let userID = document.createElement('td');
      userID.id = 'userID' + i;
    if(json["middleName"][i] == null){
      NameHolderUser = json["firstName"][i] + " " + json["lastName"][i];
    }
    else{
      NameHolderUser = json["firstName"][i] + " " + json["middleName"][i] + " " + json["lastName"][i];
    }  
    let nameUser = document.createElement('td');
      nameUser.id = 'nameUser' + i;
    let usernameUser = document.createElement('td');
      usernameUser.id = 'usernameUser' + i;
    let roleUser = document.createElement('td');
      roleUser.id = 'roleUser' + i;
    if(json["active"][i] == 1){
        isActiveUser = "active"
    }
    else{
      isActiveUser = "Inactive"
    }  
    let activeUser = document.createElement('td');
      activeUser.id = 'activeUser' + i;
    document.querySelector('#userListRows').appendChild(tableRow);//tbody
      document.querySelector('#userList' + i).appendChild(userID);
        document.querySelector('#userID' + i).innerHTML = json["userID"][i];
      document.querySelector('#userList' + i).appendChild(nameUser);
        document.querySelector('#nameUser' + i).innerHTML = NameHolderUser;
      document.querySelector('#userList' + i).appendChild(usernameUser);
        document.querySelector('#usernameUser' + i).innerHTML = json["username"][i];
      document.querySelector('#userList' + i).appendChild(roleUser);
        document.querySelector('#roleUser' + i).innerHTML = json["role"][i];
      document.querySelector('#userList' + i).appendChild(activeUser);
        document.querySelector('#activeUser' + i).innerHTML = isActiveUser;
}
function populateTableAudit(i, json){
  let tableRow = document.createElement('tr');
    tableRow.id = 'AuditList' + i;
    let logID = document.createElement('td');
      logID.id = 'logID' + i;
    studentNameHolder = json["firstName"][i] + " " + json["lastName"][i];
    let name = document.createElement('td');
      name.id = 'name' + i;
    let dateTime = document.createElement('td');
      dateTime.id = 'dateTime' + i;
    let process = document.createElement('td');
      process.id = 'process' + i;
    if(json["note"][i] == null){
        noteMessage = "N/A"
    }else{
        noteMessage = json["note"][i];
    }
    let note = document.createElement('td');
    note.id = 'note' + i;
    document.querySelector('#AuditListRows').appendChild(tableRow);//tbody
      document.querySelector('#AuditList' + i).appendChild(logID);
          document.querySelector('#logID' + i).innerHTML = json["logID"][i];
      document.querySelector('#AuditList' + i).appendChild(name);
          document.querySelector('#name' + i).innerHTML = studentNameHolder;
      document.querySelector('#AuditList' + i).appendChild(dateTime);
          document.querySelector('#dateTime' + i).innerHTML = json["dateTime"][i];
      document.querySelector('#AuditList' + i).appendChild(process);
          document.querySelector('#process' + i).innerHTML = json["process"][i];
      document.querySelector('#AuditList' + i).appendChild(note);
          document.querySelector('#note' + i).innerHTML = noteMessage;
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
document.addEventListener("DOMContentLoaded", function() {
  document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
  document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});
