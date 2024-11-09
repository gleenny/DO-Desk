const adminurl = "../PHP/admin.php";
const auditurl = "../PHP/audit.php";

const form = document.querySelector('#myform');
const searchForm = document.getElementById('searchForm');
const updateStatusForm = document.querySelector('#updateStatusForm');
const changePasswordForm = document.querySelector('#changePasswordForm');
const changeUsernameForm = document.querySelector('#changeUsernameForm');

let rowCount = 0;
getUserInfo();
getAudit();
getAdminID();


// Get the modal
var modal1 = document.getElementById("modalRegister");
var modal2 = document.getElementById("modalUpdateStatus");
var modal3 = document.getElementById("modalChangePassword");
var modal4 = document.getElementById("modalChangeUsername");

// Get the button that opens the modal
var btn1 = document.getElementById("btnRegister");
var btn2 = document.getElementById("btnUpdateStatus");
var btn3 = document.getElementById("btnChangePassword");
//var btn4 = document.getElementById("btnChangeUsername");

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[0];
var span3 = document.getElementsByClassName("close")[0];
var span4 = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn1.onclick = function() {
  modal1.style.display = "block";
}
btn2.onclick = function() {
  modal2.style.display = "block";
}
btn3.onclick = function() {
  modal3.style.display = "block";
}

/*btn4.onclick = function() {
  modal4.style.display = "block";
}*/

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
span4.onclick = function() {
  modal4.style.display = "none";
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
}
// for audit trail
function getAudit(){
  fetch(auditurl, {
      method: 'GET'
  }).then((Response) => Response.json())
  .then((json) => {
      console.log("Displaying Audit Trail")    
      logRowCount = json["logID"].length;
      for(let i = 0; i <= logRowCount - 1; i++){
        populateTableAudit(i, json);
      }
  })
}
//populate the table audit trail 
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
//change username
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
      console.log(body)
  })
})

//change password
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

//register new user
form.addEventListener('submit', (e) => {
  e.preventDefault()

  const formData = new FormData();
  //id from modal register admin
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
        console.log("Resetting table"); 
        resetTable();
        console.log("Repopulating table"); 
        getUserInfo();
    })
  }else{
    showSnackbar("missing field");
  }
});

//search from list of User
searchForm.addEventListener('submit', function (e) {
  e.preventDefault(); // Prevent default form submission

  const formData = new FormData();

    //id from modal register admin
    formData.append("userID", document.querySelector("#searchUserID").value);
    formData.append("name", document.querySelector("#searchName").value);
    formData.append("status", document.querySelector("#searchStatus").value);

    //opening the SearchStudentViolation
    formData.append("requestType", "searchUser");
  
      fetch(adminurl, {
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

          rowCount = json["userID"].length;
  
          for(let i = 0; i <= rowCount - 1; i++){
              populateTable(i, json);
          }
      })
      .catch(error => {
          console.log("An error occure: " + error);
          getUserInfo();
      })
});
//update Status of user
updateStatusForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const formData = new FormData();

  //id from modalUpdateStatus
  formData.append("adminID", document.querySelector("#adminID").value);
  formData.append("adminStatus", document.querySelector("#adminStatus").value);

  formData.append("requestType", "updateStatus");

  fetch(adminurl, {
      method: 'POST',
      body: formData
  }).then((Response) =>{
      return Response.text()
  }).then((body) => {
      showSnackbar(body);
      console.log("Resetting table");
      resetTable();
      console.log("Repopulating table");
      getUserInfo();
  })
});

//update Role of Admin
/*updateStatusForm.addEventListener('submit', (e) => {
  e.preventDefault();

  const formData = new FormData();

  formData.append("adminID", document.querySelector("#adminID").value);
  formData.append("adminStatus", document.querySelector("#adminStatus").value);

  formData.append("requestType", "updateStatus");

  fetch(adminurl, {
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
      getUserInfo();
  })
});*/

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

//list of Disciplinary Officer 
function getUserInfo(){
  fetch(adminurl, {
      method: 'GET'
  }).then((Response) => Response.json())
  .then((json) => {
      console.log("Displaying list of Users")    
      rowCount = json["userID"].length;
      for(let i = 0; i <= rowCount - 1; i++){
          populateTable(i, json);
      }
  })
}

function resetTable(){
  for(let i = 0; i <= rowCount - 1; i++){
      document.querySelector("#userListRows").deleteRow(0);
  }
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

          let passwordUser = document.createElement('td');
          passwordUser.id = 'passwordUser' + i;

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

          document.querySelector('#userList' + i).appendChild(passwordUser);
            document.querySelector('#passwordUser' + i).innerHTML = json["password"][i];

          document.querySelector('#userList' + i).appendChild(roleUser);
            document.querySelector('#roleUser' + i).innerHTML = json["role"][i];

          document.querySelector('#userList' + i).appendChild(activeUser);
            document.querySelector('#activeUser' + i).innerHTML = isActiveUser;
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
