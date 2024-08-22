//data
const userTitle = "Disciplinary Officer";
const picturePathFile = '/DO DESK/PICTURE/';

let userName = "Gleenn Melgarejo"
let profilePicPath = 'Profile.jpg';
//event lists
let events = 3;
let eventTypeData = "Drug Test";
let eventDateData = "August 30, 2024";
//total violations
let totalMinorViolations = 6;
let totalMajorViolations = 46;
//report lists
let reports = 3;
let studentNumberData = '02000393';
let lastNameData = 'Hall';
let firstNameData = 'Jason';
let middleNameData = 'Thor';
let courseData = 'BSIT';
let timeInData = '1:11pm';
let timeOutData = '2:22pm';
let statusData = 'Done';

setEventList();
setUserInfo();
setTotalViolations();
setReportLists();

//display user info
function setUserInfo(){
    document.querySelector('.account-name').innerHTML = userName;
    document.querySelector('.account-title').innerHTML = userTitle;
    document.querySelector('#profilePic').setAttribute('src', picturePathFile + profilePicPath);
}

//dispay event list
function setEventList(){
    for(let i = 1; i <= events; i++){

        let eventWrapper = document.createElement('div');
            eventWrapper.classList.add('event-wrapper');
            eventWrapper.id = 'eventWrapper' + i
    
        let eventName = document.createElement('div');
            eventName.classList.add('event-name');
            eventName.id = 'eventName' + i
    
        let eventType = document.createElement('div');
            eventType.classList.add('event-type');
            eventType.id = 'eventType' + i
    
        let eventDate = document.createElement('div');
            eventDate.classList.add('event-date');
            eventDate.id = 'eventDate' + i
    
            document.querySelector('.card.calendarEvent').appendChild(eventWrapper);
            document.querySelector('#eventWrapper' + i).appendChild(eventName);
                document.querySelector('#eventName' + i).appendChild(eventType);
            document.querySelector('#eventType' + i).innerHTML = eventTypeData;
                document.querySelector('#eventName' + i).appendChild(eventDate);
            document.querySelector('#eventDate' + i).innerHTML = eventDateData;
    }
}

function setTotalViolations(){
    document.querySelector('.subtitle-count').innerHTML = totalMinorViolations;
    document.querySelector('.subtitle-count.dist').innerHTML = totalMajorViolations;
    document.querySelector('.counter').innerHTML = totalMinorViolations + totalMajorViolations;
}

//design ng scroll
document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});

//GAWAN MO NG DI HARCODED YUNG REPORT LIST
//DI PA FINAL TO
function setReportLists(){
    for(let i = 1; i <= reports; i++){
        let tableRow = document.createElement('tr');
        tableRow.id = 'reportList' + i;
    
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
        
        //baka tanggalin to
        let timeIn = document.createElement('td');
        timeIn.id = 'timeIn' + i;
        let timeOut = document.createElement('td');
        timeOut.id = 'timeOut' + i;
        
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
    
        document.querySelector('#reportList' + i).appendChild(timeIn);
            document.querySelector('#timeIn' + i).innerHTML = timeInData;
            
        document.querySelector('#reportList' + i).appendChild(timeOut);
            document.querySelector('#timeOut' + i).innerHTML = timeOutData;
    
        document.querySelector('#reportList' + i).appendChild(status);
        document.querySelector('#status' + i).appendChild(statusDiv);
            document.querySelector('#statusDiv' + i).innerHTML = statusData;
    }
}

