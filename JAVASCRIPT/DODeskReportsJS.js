const audioPlayer = document.querySelector('#audioPlayer');
const searchFiles = document.querySelector('#searchBTN');
const txtPath = "../txt/"
const audioPath = "../audio/"
const url = '../PHP/transcripts.php';

let rowCount = 0;

//searching for violation
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
        //setting student info
        if(json["middleName"][0] == null){
            studentNameHolder = json["firstName"][0] + " " + json["lastName"][0];
        }
        else{
            studentNameHolder = json["firstName"][0] + " " + json["middleName"][0] + " " + json["lastName"][0];
        } 
        document.querySelector('#studentInfo').innerHTML = studentNameHolder + " : " + json["studentNumber"][0]
        document.querySelector('#violationIDInfo').innerHTML = "violationID: " + json["violationID"][0]
        resetTable();
        rowCount = json["studentNumber"].length;
        //populating table
        for(let i = 0; i <= rowCount - 1; i++){
            populateTable(i, json);
        }
    }).catch(error => {
        console.log("an error occured: " + error)
    })
});

//set text file and audio file
function setTranscribe(btnvalue){
    //set text
    fileParts = btnvalue.split("-");
    fetch('../txt/' + fileParts[0] + '.txt')
    .then((res) => res.text())
    .then((text) =>{
        document.querySelector("#myTextarea").innerHTML = text;
    }).catch(error => {
        console.log("an error occured: " + error);
    })
    //set audio
    document.querySelector('#audioPlayer').setAttribute('src', audioPath+fileParts[0] + '.' + fileParts[1])
    document.querySelector('#audio').load();
}

//removing table content
function resetTable(){
    for(let i = 0; i <= rowCount - 1; i++){
        document.querySelector("#transcriptFiles").deleteRow(0);
    }
}

//adding table content
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

    document.querySelector('#transcriptFiles').appendChild(tableRow);//tbody

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

document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});