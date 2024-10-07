const url = "../PHP/getViolationsData.php";

let minor = 3;
let major = 4;
let community = 5;
let pending = 6;

let reports = 1;
let recordedByData = 'Mrs.Facturan'
let studentNumberData = '02000393';
let lastNameData = 'Hall';
let firstNameData = 'Jason';
let middleNameData = 'Thor';
let courseData = 'BSIT';
let levelData = '4YR A705';
let violationData = 'Minor';
let statusData = 'Done';

let studentCount = 0;

setCounts();
getViolationInfo();

function setCounts(){
    document.querySelector('#minorCount').innerHTML = minor;
    document.querySelector('#majorCount').innerHTML = major;
    document.querySelector('#communityCount').innerHTML = community;
    document.querySelector('#pendingCount').innerHTML = pending;
    
}

function getViolationInfo(){
    fetch(url, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        console.log("Displaying list of violation cases") 
        for(let i = 0; i <= (json["Officer"].length - 1); i++){

            let tableRow = document.createElement('tr');
            tableRow.id = 'violationList' + i;
        
            let RecordedBy = document.createElement('td');
            RecordedBy.id = 'RecordedBy' + i;

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
            let section = document.createElement('td');
            section.id = 'section' + i;
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


            document.querySelector('#reportListRows').appendChild(tableRow);//tbody
            document.querySelector('#violationList' + i).appendChild(RecordedBy);
                document.querySelector('#RecordedBy' + i).innerHTML = json["recordedBy"][i];

            document.querySelector('#violationList' + i).appendChild(studentNumber);
                document.querySelector('#studentNumber' + i).innerHTML = json["studentNumber"][i];

            document.querySelector('#violationList' + i).appendChild(studentName);
                document.querySelector('#studentName' + i).innerHTML = studentNameHolder;

            document.querySelector('#violationList' + i).appendChild(course);
                document.querySelector('#course' + i).innerHTML = json["course"][i];

            document.querySelector('#violationList' + i).appendChild(section);
                document.querySelector('#section' + i).innerHTML = json["section"][i];

            document.querySelector('#violationList' + i).appendChild(violationType);
                document.querySelector('#violationType' + i).innerHTML = json["violationType"][i];

            document.querySelector('#violationList' + i).appendChild(violationCase);
                document.querySelector('#violationCase' + i).innerHTML = json["violationCase"][i];

            document.querySelector('#violationList' + i).appendChild(active);
                document.querySelector('#active' + i).innerHTML = resolveHolder;
        }

        //document.querySelector('#student').innerHTML = json["studentNumber"][0];
    })
}















/*function setReportLists(){
    for(let i = 1; i <= reports; i++){
        let tableRow = document.createElement('tr');
        tableRow.id = 'reportList' + i;
    
        let recordedBy = document.createElement('td');
        recordedBy.id = 'recordedBy' + 1;
        let studentNumber = document.createElement('td');
        studentNumber.id = 'studentNumber' + i;
        let lastName = document.createElement('td');
        lastName.id = 'lastName' + i;
        let firstName = document.createElement('td');
        firstName.id = 'firstName' + i;
        let middleName = document.createElement('td');
        middleName.id = 'middleName' + i;
        let course = document.createElement('td');
        course.id = 'course' + i;
        let level = document.createElement('td');
        level.id = 'level' + i;
        let violation = document.createElement('td');
        violation.id = 'violation' + i;
        
        //status
        let status = document.createElement('td');
        status.id = 'status' + i;
        let statusDiv = document.createElement('div');
        statusDiv.id = 'statusDiv' + i;
        statusDiv.classList.add('status');
        if(statusData == 'Done'){
            statusDiv.classList.add('is-green');
        }
        else if(statusData == 'Pending'){
            statusDiv.classList.add('is-red');
        }
        else if(statusData == 'Waiting'){
            statusDiv.classList.add('is-wait');
        }
    
        document.querySelector('#reportListRows').appendChild(tableRow);
        document.querySelector('#reportList' + i).appendChild(recordedBy);
            document.querySelector('#recordedBy' + i).innerHTML = recordedByData;

        document.querySelector('#reportList' + i).appendChild(studentNumber);
            document.querySelector('#studentNumber' + i).innerHTML = studentNumberData;
    
        document.querySelector('#reportList' + i).appendChild(lastName);
            document.querySelector('#lastName' + i).innerHTML = lastNameData;
    
        document.querySelector('#reportList' + i).appendChild(firstName);
            document.querySelector('#firstName' + i).innerHTML = firstNameData;
    
        document.querySelector('#reportList' + i).appendChild(middleName);
            document.querySelector('#middleName' + i).innerHTML = middleNameData;
    
        document.querySelector('#reportList' + i).appendChild(course);
            document.querySelector('#course' + i).innerHTML = courseData;

        document.querySelector('#reportList' + i).appendChild(level);
            document.querySelector('#level' + i).innerHTML = levelData;

        document.querySelector('#reportList' + i).appendChild(violation);
            document.querySelector('#violation' + i).innerHTML = violationData;
    
        document.querySelector('#reportList' + i).appendChild(status);
        document.querySelector('#status' + i).appendChild(statusDiv);
            document.querySelector('#statusDiv' + i).innerHTML = statusData;
    }
}
    */


document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});
