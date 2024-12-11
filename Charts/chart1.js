
const violation = document.getElementById('barchartViolation').getContext('2d');
const barchartViolation= new Chart(violation, {
    type: 'bar',
    data: {
        labels: ['violation1', 'violation2', 'violation3', 'violation4', 'violation5', 'violation6', 'violation7', 'violation8', 'violation9', 'violation10', 'violation11'],
        datasets: [
            {
                label: 'Pageviews by Violations',
                data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
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



const sanction = document.getElementById('barchartSanction').getContext('2d');
const barchartSanction = new Chart(sanction, {
    type: 'bar',
    data: {
        labels: ["sanction1", "sanction2", "sanction3", "sanction4", "sanction5", "sanction6", "sanction7"],
        datasets: [
            {
                label: 'Pageviews by Violations',
                data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
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

