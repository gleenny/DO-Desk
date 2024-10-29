const adminurl = "../PHP/admin.php";
const form = document.querySelector('#myform');
const searchForm = document.getElementById('searchForm');
const updateStatusForm = document.querySelector('#updateStatusForm');

let rowCount = 0;
getUserInfo();

// Get the modal
var modal1 = document.getElementById("modalRegister");
//var modal2 = document.getElementById("modalUpdateRole");
var modal3 = document.getElementById("modalUpdateStatus");


// Get the button that opens the modal
var btn1 = document.getElementById("btnRegister");
//var btn2 = document.getElementById("btnUpdateRole");
var btn3 = document.getElementById("btnUpdateStatus");


// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close")[0];
//var span2 = document.getElementsByClassName("close")[0];
var span3 = document.getElementsByClassName("close")[0];


// When the user clicks on the button, open the modal
btn1.onclick = function() {
  modal1.style.display = "block";
}
//btn2.onclick = function() {
//  modal2.style.display = "block";
//}
btn3.onclick = function() {
  modal3.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span1.onclick = function() {
  modal1.style.display = "none";
}
//span2.onclick = function() {
//  modal2.style.display = "none";
//}
span3.onclick = function() {
  modal3.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
  //else if (event.target == modal2) {
  //  modal2.style.display = "none";
  //}
  else if (event.target == modal3) {
    modal3.style.display = "none";
  }
}


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

  fetch(adminurl, {
      method: 'POST',
      body: formData,
  }).then((Response) => {
      return Response.text()
  }).then((body) => {
      console.log(body)
      console.log("Resetting table"); 
      resetTable();
      console.log("Repopulating table"); 
      getUserInfo();
  })
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
      console.log(body);
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
            nameHolder = json["firstName"][i] + " " + json["lastName"][i];
          }
          else{
            nameHolder = json["firstName"][i] + " " + json["middleName"][i] + " " + json["lastName"][i];
          }  
          let name = document.createElement('td');
          name.id = 'name' + i;

          let username = document.createElement('td');
          username.id = 'username' + i;

          let password = document.createElement('td');
          password.id = 'password' + i;

          let role = document.createElement('td');
          role.id = 'role' + i;

          if(json["active"][i] == 1){
              isActive = "active"
          }
          else{
              isActive = "Inactive"
          }  
          let active = document.createElement('td');
          active.id = 'active' + i;

          document.querySelector('#userListRows').appendChild(tableRow);//tbody

          document.querySelector('#userList' + i).appendChild(userID);
            document.querySelector('#userID' + i).innerHTML = json["userID"][i];

          document.querySelector('#userList' + i).appendChild(name);
            document.querySelector('#name' + i).innerHTML = nameHolder;

          document.querySelector('#userList' + i).appendChild(username);
            document.querySelector('#username' + i).innerHTML = json["username"][i];

          document.querySelector('#userList' + i).appendChild(password);
            document.querySelector('#password' + i).innerHTML = json["password"][i];

          document.querySelector('#userList' + i).appendChild(role);
            document.querySelector('#role' + i).innerHTML = json["role"][i];

          document.querySelector('#userList' + i).appendChild(active);
            document.querySelector('#active' + i).innerHTML = isActive;
}

document.addEventListener("DOMContentLoaded", function() {
  document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
  document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});