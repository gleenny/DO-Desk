const violationurl = '../PHP/violations.php';
const sanctionurl = '../PHP/sanction.php';

var chosen = document.querySelector('#searchYear')

let chosenYear = 2024;

getviolationTypeOverall()
getviolationResolveOverall();
getOverallSanctionResolve()
barchartCourseViolation()
barchartTop5Violation()
barchartYearlySanction()
populateYear()

chosen.addEventListener('change', (e) => {
    e.preventDefault();

    chosenYear = document.querySelector('#searchYear').value;
    
    barchartYearlySanction()
    barchartCourseViolation()
    barchartTop5Violation()
})

function populateYear(){
    let today = new Date();
    let year = today.getFullYear();
    for(i = year; i >= 2015; i--){
        let opt = document.createElement('option');
            opt.text = i
            opt.value = i
            document.querySelector('#searchYear').options.add(opt);
    }
}
function barchartCourseViolation(){
    const formData  = new FormData();
    formData.append('year', chosenYear)
    formData.append('requestType', 'violationCourse')

    fetch(violationurl, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => { 
        let newData = [json['count'][0], json['count'][1], json['count'][2], json['count'][3], json['count'][4], json['count'][5], json['count'][6], json['count'][7], json['count'][8], json['count'][9]];
        barchartViolationCourse.data.datasets[0].data = newData;
        barchartViolationCourse.update();
    });
}
function barchartTop5Violation(){
    const formData  = new FormData();
    formData.append('year', chosenYear)
    formData.append('requestType', 'violationTop5')

    fetch(violationurl, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => { 
        let newData = [json['count'][0], json['count'][1], json['count'][2], json['count'][3], json['count'][4]];
        let newLabel = [json['offense'][0], json['offense'][1], json['offense'][2], json['offense'][3], json['offense'][4]]
        barchartViolationTop5.data.datasets[0].data = newData;
        barchartViolationTop5.data.labels = newLabel;
        barchartViolationTop5.update();
    });
}
function barchartYearlySanction(){
    const formData  = new FormData();
    formData.append('year', chosenYear)
    formData.append('requestType', 'SanctionYear')

    fetch(sanctionurl, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => { 
        let newData = [json['count'][0], json['count'][1], json['count'][2], json['count'][3], json['count'][4]];
        let newLabel = [json['sanction'][0], json['sanction'][1], json['sanction'][2], json['sanction'][3], json['sanction'][4]]
        barchartSanction.data.datasets[0].data = newData;
        barchartSanction.data.labels = newLabel;
        barchartSanction.update();
    });
}
function getviolationTypeOverall(){
    const formData = new FormData();
    formData.append('requestType', 'getOverallTypeViolation')

    fetch(violationurl, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => {
        let majorCount = 0;
        let minorCount = 0;
        if(json['violationType'][0] == 'Major'){
            majorCount = json['count'][0]
            minorCount = json['count'][1]
        }else{
            majorCount = json['count'][1]
            minorCount = json['count'][0]
        }
        document.querySelector('#violationMajor').innerHTML = majorCount;
        document.querySelector('#violationMinor').innerHTML = minorCount;
        const Violationdoughnut = document.getElementById('doughnutViolationCaseOverall').getContext('2d');
        const doughnutViolationOverall = new Chart(Violationdoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Major', 'Minor'],
                datasets: [{
                    label: '# of Votes',
                    data: [majorCount, minorCount],
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

function getviolationResolveOverall(){
    const formData = new FormData();
    formData.append('requestType', 'getOverallResolveViolation')

    fetch(violationurl, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => {
        document.querySelector("#violationResolve").innerHTML = json['count'][0];
        document.querySelector("#violationUnresolve").innerHTML = json['count'][1];
        const Violationdoughnut = document.getElementById('doughnutViolationResolveOveralls').getContext('2d');
        const doughnutViolationOverall = new Chart(Violationdoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Unresolved', 'Resolved'],
                datasets: [{
                    label: '# of Votes',
                    data: [json['count'][1], json['count'][0]],
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

function getOverallSanctionResolve(){
    const formData = new FormData();
    formData.append('requestType', 'getOverallResolveSanction')

    fetch(sanctionurl, {
        method: 'POST',
        body: formData
    }).then((Response) => Response.json())
    .then((json) => {
        document.querySelector('#sanctionResolve').innerHTML = json['count'][0]
        document.querySelector('#sanctionUnresolve').innerHTML = json['count'][1]
        const Sanctiondoughnut = document.getElementById('doughnutSanctionOverall').getContext('2d');
        const doughnutSanctionOverall = new Chart(Sanctiondoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Unresolved', 'Resolved'],
                datasets: [{
                    label: '# of Votes',
                    data: [json['count'][1], json['count'][0]],
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

const sanction = document.getElementById('barchartSanction').getContext('2d'); //sanction bar
    const barchartSanction = new Chart(sanction, {
        type: 'bar',
        data: {
            labels: ['violation 1', 'violation 2', 'violation 3', 'violation 4', 'violation 5'],
            datasets: [
                {
                    label: 'Pageviews by Violations',
                    data: [1, 2, 3, 4, 5],
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
const violationTop5 = document.getElementById('barchartTop5Violation').getContext('2d'); //violation bar
    const barchartViolationTop5 = new Chart(violationTop5, {
        type: 'bar', 
        data: {
            labels: ['violation 1', 'violation 2', 'violation 3', 'violation 4', 'violation 5'],
            datasets: [
                {
                    label: 'Pageviews by Violations',
                    data: [1, 2, 3, 4, 5],
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
const violationCourse = document.getElementById('barchartCourseViolation').getContext('2d'); //violation bar course
    var barchartViolationCourse = new Chart(violationCourse, {
        type: 'bar', 
        data: {
            labels: ['ABM', 'BACOMM', 'BSAIS', 'BSBA', 'BSCpE', 'BSCS', 'BSHM', 'BSIT', 'BSTM,'],
            datasets: [
                {
                    label: 'Violations per Course in ' + chosenYear,
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0],
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