//link 
const url = "../PHP/violations.php";

//data
const picturePathFile = '/DO DESK/PICTURE/';

let profilePicPath = 'Profile.jpg';
//event lists
let events = 3;
let eventTypeData = "Drug Test";
let eventDateData = "August 30, 2024";
//report lists
let reports = 1;
let studentNumberData = '02000393';
let lastNameData = 'Hall';
let firstNameData = 'Jason';
let middleNameData = 'Thor';
let courseData = 'BSIT';
let timeInData = '1:11pm';
let timeOutData = '2:22pm';
let statusData = 'Done';

setEventList();
setData();

//display user info
function setUserInfo(){
    document.querySelector('.account-name').innerHTML = userName;
    document.querySelector('.account-title').innerHTML = userTitle;
    document.querySelector('#profilePic').setAttribute('src', picturePathFile + profilePicPath);
}
//TANGGAL NA SIGURO TO
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
function setData(){
    fetch(url, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        //setting violation counts
        document.querySelector('#minorCount').innerHTML = json["minorCount"]
        document.querySelector('#majorCount').innerHTML = json["majorCount"]
        //setting record List
        console.log("Displaying list of violation cases") 
        for(let i = 0; i <= (json["Officer"].length) - 1 && i < 5; i++){

            let tableRow = document.createElement('tr');
            tableRow.id = 'violationList' + i;
        
            let doName = document.createElement('td');
            doName.id = 'doName' + i;

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
            document.querySelector('#violationList' + i).appendChild(doName);
                document.querySelector('#doName' + i).innerHTML = json["doFirst"][i] + " " + json["doLast"][i];

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
    })
}

//design ng scroll
document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});

