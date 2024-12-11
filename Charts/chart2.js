const Violationdoughnut = document.getElementById('doughnutViolation').getContext('2d');
const doughnutViolation = new Chart(Violationdoughnut, {
    type: 'doughnut',
    data: {
        labels: ['Minor', 'Major'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19],
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

const Sanctiondoughnut = document.getElementById('doughnutSanction').getContext('2d');
const doughnutSanction = new Chart(Sanctiondoughnut, {
    type: 'doughnut',
    data: {
        labels: ['Resolved', 'Unresolved'],
        datasets: [{
            label: '# of Votes',
            data: [12, 10],
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