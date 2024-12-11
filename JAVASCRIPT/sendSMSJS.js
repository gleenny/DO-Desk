const url = "../PHP/semaphoreAPI.php";
const smsForm = document.querySelector("#myformSMS");
const searchForm = document.querySelector("#myformFindParent");

let rowCount = 0;
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
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
}

//searching information
searchForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const formData = new FormData();

    formData.append("studentName", document.querySelector('#studentName').value);
    formData.append("requestType", "searchParent");

    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => {
        console.log("Clearing the table") 
        for(let i = 0; i <= rowCount - 1; i++){
            console.log("count " + i)
            document.querySelector("#reportListRows").deleteRow(0);
        }
        console.log("Displaying list of violation cases") 
        rowCount = json["studentNumber"].length;
        for(let i = 0; i <= rowCount - 1; i++){

            let tableRow = document.createElement('tr');
            tableRow.id = 'studentParents' + i;

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

            if(json["parentMiddle"][i] == null){
                parentNameHolder = json["parentFirst"][i] + " " + json["parentLast"][i];
            }
            else{
                parentNameHolder = json["parentFirst"][i] + " " + json["parentMiddle"][i] + " " + json["parentLast"][i];
            }  

            let parentName = document.createElement('td');
            parentName.id = 'parentName' + i;
            let mobileNumber = document.createElement('td');
            mobileNumber.id = 'mobileNumber' + i;

            document.querySelector('#reportListRows').appendChild(tableRow);//tbody

            document.querySelector('#studentParents' + i).appendChild(studentNumber);
                document.querySelector('#studentNumber' + i).innerHTML = json["studentNumber"][i];

            document.querySelector('#studentParents' + i).appendChild(studentName);
                document.querySelector('#studentName' + i).innerHTML = studentNameHolder;

            document.querySelector('#studentParents' + i).appendChild(parentName);
                document.querySelector('#parentName' + i).innerHTML = parentNameHolder;

            document.querySelector('#studentParents' + i).appendChild(mobileNumber);
                document.querySelector('#mobileNumber' + i).innerHTML = json["mobileNumber"][i];
        }
    }).catch(error => {
        console.log("An error occure: " + error);
    })
})

//sending message
smsForm.addEventListener('submit', (e) => {
    e.preventDefault();

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;

    const formData = new FormData();

    formData.append("studentNumber", document.querySelector('#studentNumber').value);
    formData.append("mobileNumber", document.querySelector('#mobileNumber').value);
    formData.append("message", document.querySelector('#message').value);
    formData.append("date", document.querySelector('#scheduleDate').value);
    formData.append("time", document.querySelector('#scheduleTime').value);
    formData.append("requestType", "sendMessage");

    if(document.querySelector('#scheduleDate').value > today){
        if(document.querySelector('#studentNumber').value && document.querySelector('#message').value && document.querySelector('#scheduleTime').value){
            SMS(formData);
        }
    }else{
        showSnackbar("Invalid Date");
    }
})
function SMS(formData){
    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        showSnackbar("Message was succesfully sent to the student's parent");
    }).catch(error => {
        showSnackbar("An error occure: " + error);
    })
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
  