const audioPlayer = document.querySelector('#audioPlayer');
const searchFiles = document.querySelector('#searchBTN');
const txtPath = "../txt/"
const audioPath = "../audio/"
const url = '../PHP/transcripts.php';
var modal1 = document.getElementById("modalSubmit");
var span1 = document.getElementsByClassName("close")[0];
span1.onclick = function(){
    modal1.style.display = "none";
}
window.onclick = function(event){
    if(event.target == modal1){
        modal1.style.display = "none";
    }
}
searchFiles.addEventListener("click", (e) =>{
    e.preventDefault();
    const formdata = new FormData();
    formdata.append("violationID", document.querySelector('#violationID').value);
    formdata.append("requestType", "getTranscripts")
    fetch(url,{
        method: 'POST',
        body: formdata
    }).then((Response) => Response.json())
    .then((json) => {
        if(Object.keys(json).length == 0){
            showSnackbar("No data match")
        }else{
            if(json["middleName"][0] == null){
                studentNameHolder = json["firstName"][0] + " " + json["lastName"][0];
            }
            else{
                studentNameHolder = json["firstName"][0] + " " + json["middleName"][0] + " " + json["lastName"][0];
            } 
            document.querySelector('#studentInfo').innerHTML = studentNameHolder + " : " + json["studentNumber"][0]
            document.querySelector('#violationIDInfo').innerHTML = "violationID: " + json["violationID"][0]
            document.querySelector("#transcriptFiles").innerHTML = '';
            for(let i = 0; i < json["studentNumber"].length; i++){
                populateTable(i, json);
            }
            showSnackbar("data has been displayed")
        } 
    }).catch(error => {
        console.log(error)
        document.querySelector("#transcriptFiles").innerHTML = '';
    })
});
function setTranscribe(btnvalue){
    modal1.style.display = "block";
    fileParts = btnvalue.split("-");
    fetch('../txt/' + fileParts[0] + '.txt')
    .then((res) => res.text())
    .then((text) =>{
        document.querySelector("#myTextarea").innerHTML = text;
    }).catch(error => {
        showSnackbar("an error occured: " + error);
    })
    document.querySelector('#audioPlayer').setAttribute('src', audioPath+fileParts[0] + '.' + fileParts[1])
    document.querySelector('#audio').load();
}
function populateTable(i, json){
    let tableRow = document.createElement('tr');
        tableRow.id = 'transcriptList' + i;
    let transcriptID = document.createElement('td');
        transcriptID.id = 'transcriptID' + i;
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
    let span = document.createElement('span');
        span.innerHTML = '<button id="transcriptName'+ i +'" onclick="setTranscribe(this.value)" value="' + json["transcriptName"][i] + '-' + json["fileExtension"][i] + '"/>';
    document.querySelector('#transcriptFiles').appendChild(tableRow);
        document.querySelector('#transcriptList' + i).appendChild(transcriptID);
            document.querySelector('#transcriptID' + i).innerHTML = json["transcriptID"][i];
        document.querySelector('#transcriptList' + i).appendChild(violationType);
            document.querySelector('#violationType' + i).innerHTML = json["violationType"][i];
        document.querySelector('#transcriptList' + i).appendChild(violationCase);
            document.querySelector('#violationCase' + i).innerHTML = json["violationCase"][i];
        document.querySelector('#transcriptList' + i).appendChild(active);
            document.querySelector('#active' + i).innerHTML = resolveHolder;
        document.querySelector('#transcriptList' + i).appendChild(violationDate);
            document.querySelector('#violationDate' + i).innerHTML = json["violationDate"][i];
        document.querySelector('#transcriptList' + i).appendChild(span);
            document.querySelector('#transcriptName' + i).innerHTML = json["transcriptName"][i];
}
function showSnackbar(message) {
    const snackbar = document.getElementById("snackbar");  
    snackbar.textContent = message;
    snackbar.classList.add("show");
    setTimeout(() => {
      snackbar.classList.remove("show");
    }, 3000);
}
document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});