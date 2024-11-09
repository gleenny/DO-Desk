const url = "../PHP/audit.php";

let rowCount;

getAudit();

function getAudit(){
    fetch(url, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        console.log("Displaying Audit Trail")    
        rowCount = json["logID"].length;
        for(let i = 0; i <= rowCount - 1; i++){
            populateTable(i, json);
        }
    })
}
function populateTable(i, json){
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