//link 
const url = "../PHP/violations.php";
const auditurl = "../PHP/audit.php";
const sanctionurl = "../PHP/sanction.php";

//data
const picturePathFile = '/DO DESK/PICTURE/';

let profilePicPath = 'Profile.jpg';

setData();
getviolationInfoBar()
getSanctionInfoBar()
getSanctionInfoPie()
getviolationInfoPie()

function setData(){
    fetch(url, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        //setting record List
        console.log("Displaying list of violation cases") 
        for(let i = 0; i <= (json["violationID"].length) - 1 && i < 5; i++){

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
            document.querySelector('#violationList' + i).appendChild(doName); //Disciplinary Officer Name
                document.querySelector('#doName' + i).innerHTML = json["doFirst"][i] + " " + json["doLast"][i];

            document.querySelector('#violationList' + i).appendChild(studentNumber); // Student Number
                document.querySelector('#studentNumber' + i).innerHTML = json["studentNumber"][i];

            document.querySelector('#violationList' + i).appendChild(studentName); // Student Name
                document.querySelector('#studentName' + i).innerHTML = studentNameHolder;

            document.querySelector('#violationList' + i).appendChild(course); //Course
                document.querySelector('#course' + i).innerHTML = json["course"][i];

            document.querySelector('#violationList' + i).appendChild(violationType); //Violation Type
                document.querySelector('#violationType' + i).innerHTML = json["violationType"][i];

            document.querySelector('#violationList' + i).appendChild(violationCase); //Case Type
                document.querySelector('#violationCase' + i).innerHTML = json["violationCase"][i];

            document.querySelector('#violationList' + i).appendChild(active); //Status
                document.querySelector('#active' + i).innerHTML = resolveHolder;
        }
        })  
}
function getSanctionInfoBar(){
    var today = new Date();
    var year = today.getFullYear();
    
    const formData = new FormData();
    formData.append("year", year);
    formData.append("requestType", "getSanctionCaseCount")
    fetch(sanctionurl, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => {
        const sanction = document.getElementById('barchartSanction').getContext('2d'); //sanction bar
        const barchartSanction = new Chart(sanction, {
            type: 'bar',
            data: {
                labels: [json['case'][0], json['case'][1], json['case'][2], json['case'][3], json['case'][4]],
                datasets: [
                    {
                        label: 'Santions for the current year: ' + year,
                        data: [json['count'][0], json['count'][1], json['count'][2], json['count'][3], json['count'][4]],
                        backgroundColor: 'rgba(130, 151, 255, 0.5)',
                        borderColor: 'rgba(130, 151, 255)',
                        borderWidth: 10
                    },
    
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
}
function getSanctionInfoPie(){
    var today = new Date();
    var year = today.getFullYear();
    
    const formData = new FormData();
    formData.append("year", year);
    formData.append('requestType', "getSanctionResolveCount")

    fetch(sanctionurl, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => {
        document.querySelector('#sanctionResolved').innerHTML = json['count'][0];
        document.querySelector('#sanctionUnresolved').innerHTML = json['count'][1];
        const Sanctiondoughnut = document.getElementById('doughnutSanction').getContext('2d'); //sanction pie
        const doughnutSanction = new Chart(Sanctiondoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Resolved', 'Unresolved'],
                datasets: [{
                    label: '# of Votes',
                    data: [json['count'][0], json['count'][1]],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
}

function getviolationInfoBar(){
    var today = new Date();
    var year = today.getFullYear();
    
    const formData = new FormData();
    formData.append("year", year);
    formData.append("requestType", "getViolationCaseCount")
    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => {
        const violation = document.getElementById('barchartViolation').getContext('2d'); //violation bar
        const barchartViolation= new Chart(violation, {
            type: 'bar', 
            data: {
                labels: [json['offense'][0], json['offense'][1], json['offense'][2], json['offense'][3], json['offense'][4]],
                datasets: [
                    {
                        label: 'Top 5 violations for the current year: ' + year,
                        data: [json['count'][0], json['count'][1], json['count'][2], json['count'][3], json['count'][4]],
                        backgroundColor: 'rgba(130, 151, 255, 0.5)',
                        borderColor: 'rgba(130, 151, 255)',
                        borderWidth: 10
                    },

                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
    });
    })
    
}
function getviolationInfoPie(){
    var today = new Date();
    var year = today.getFullYear();
    
    const formData = new FormData();
    formData.append("year", year);
    formData.append('requestType', "getViolationResolveCount")

    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => {
        document.querySelector('#violationResolve').innerHTML = json['count'][0]
        document.querySelector('#violationUnresolve').innerHTML = json['count'][1]

        const Violationdoughnut = document.getElementById('doughnutViolation').getContext('2d'); //violation pie
            const doughnutViolation = new Chart(Violationdoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['Resolved', 'Unresolved'],
                    datasets: [{
                        label: '# of Votes',
                        data: [json['count'][0], json['count'][1]],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
    })
    
}
//design ng scroll
document.addEventListener("DOMContentLoaded", function() {
    document.body.style.setProperty('--scrollbar-thumb-color', 'purple');
    document.body.style.setProperty('--scrollbar-track-color', '#f1f1f1');
});

