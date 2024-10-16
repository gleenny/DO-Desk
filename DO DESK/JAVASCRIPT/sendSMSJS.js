const url = "../PHP/semaphoreAPI.php";
const smsForm = document.querySelector("#myformSMS");
const searchForm = document.querySelector("#myformFindParent");

let rowCount = 0;

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

    if(document.querySelector('#scheduleDate').value > today){
        const formData = new FormData();

        formData.append("studentNumber", document.querySelector('#studentNumber').value);
        formData.append("message", document.querySelector('#message').value);
        formData.append("date", document.querySelector('#scheduleDate').value);
        formData.append("requestType", "sendMessage");

        fetch(url, {
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