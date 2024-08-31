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

setCounts();
setReportLists();

function setCounts(){
    document.querySelector('#minorCount').innerHTML = minor;
    document.querySelector('#majorCount').innerHTML = major;
    document.querySelector('#communityCount').innerHTML = community;
    document.querySelector('#pendingCount').innerHTML = pending;
    
}
function setReportLists(){
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


document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});
