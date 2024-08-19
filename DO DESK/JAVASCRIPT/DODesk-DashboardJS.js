//data
const userTitle = "Disciplinary Officer";
const picturePathFile = '/DO DESK/PICTURE/';

let userName = "Gleenn Melgarejo"
let events = 3;
let eventTypeData = "Drug Test";
let eventDateData = "August 30, 2024";
let profilePicPath = 'Profile.jpg';

//display user info
document.querySelector('.account-name').innerHTML = userName;
document.querySelector('.account-title').innerHTML = userTitle;

//display profile picture
document.querySelector('#profilePic').setAttribute('src', picturePathFile + profilePicPath);

//dispay event list
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

//design ng scroll
document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});


//GAWAN MO NG DI HARCODED YUNG REPORT LIST
//YUNG SA MINOR/MAJOR VIOLATIONS PAKIAYSO DIN