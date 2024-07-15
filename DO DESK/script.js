const calendarBody = document.getElementById('calendar-body');
const monthYear = document.getElementById('month-year');
const scheduleBody = document.getElementById('schedule-body');
const prevMonthButton = document.getElementById('prev-month');
const nextMonthButton = document.getElementById('next-month');
const scheduleButton = document.getElementById('schedule-btn');
const modal = document.getElementById('schedule-modal');
const closeModal = document.querySelector('.close');
const scheduleForm = document.getElementById('schedule-form');
const eventDateInput = document.getElementById('event-date');
const eventNameInput = document.getElementById('event-name');
const currentDatetimeDisplay = document.getElementById('current-datetime');
const eventDetailsModal = document.getElementById('event-details-modal');
const eventDetailsContent = document.getElementById('event-details-content');
const eventsBody = document.getElementById('events-body');
const monthYearEvents = document.getElementById('month-year-events');
const prevMonthEventsButton = document.getElementById('prev-month-events');
const nextMonthEventsButton = document.getElementById('next-month-events');

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

const holidays = [
    { date: '2024-07-04', name: 'Independence Day' },
    { date: '2024-12-25', name: 'Christmas Day' },
    // Add more holidays here
];

const scheduledDates = [
    { date: '2024-07-15', event: 'Project Deadline' },
    { date: '2024-08-01', event: 'Team Meeting' },
    // Add more scheduled dates here
];

function updateCalendar(month, year) {
    calendarBody.innerHTML = '';
    const firstDay = new Date(year, month).getDay();
    const daysInMonth = 32 - new Date(year, month, 32).getDate();

    let date = 1;
    for (let i = 0; i < 6; i++) {
        const row = document.createElement('tr');

        for (let j = 0; j < 7; j++) {
            const cell = document.createElement('td');

            if (i === 0 && j < firstDay) {
                const cellText = document.createTextNode('');
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth) {
                break;
            } else {
                const cellText = document.createTextNode(date);
                cell.appendChild(cellText);

                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;

                if (holidays.some(holiday => holiday.date === dateStr)) {
                    cell.classList.add('holiday');
                }

                const scheduledEvent = scheduledDates.find(event => event.date === dateStr);
                if (scheduledEvent) {
                    cell.classList.add('scheduled');
                    cell.addEventListener('click', () => showEventDetails(dateStr, scheduledEvent.event));
                } else {
                    cell.addEventListener('click', () => showEventDetails(dateStr, null));
                }

                row.appendChild(cell);
                date++;
            }
        }

        calendarBody.appendChild(row);
    }

    monthYear.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;
}

function showEventDetails(date, event) {
    eventDetailsContent.innerHTML = '';
    const dateStr = new Date(date).toLocaleDateString('default', { year: 'numeric', month: 'long', day: 'numeric' });
    const eventDetail = document.createElement('p');
    if (event) {
        eventDetail.textContent = `Event on ${dateStr}: ${event}`;
    } else {
        eventDetail.textContent = `No events scheduled for ${dateStr}`;
    }
    eventDetailsContent.appendChild(eventDetail);
    eventDetailsModal.style.display = 'block';
}

function updateScheduleTable() {
    const today = new Date();
    const todayStr = today.toISOString().split('T')[0];
    const todayEvents = scheduledDates.filter(event => event.date === todayStr);

    scheduleBody.innerHTML = '';

    if (todayEvents.length === 0) {
        const row = document.createElement('tr');
        const noEventCell = document.createElement('td');
        noEventCell.textContent = 'No events scheduled for today.';
        noEventCell.colSpan = 2; // Ensure the cell spans both date and event columns
        row.appendChild(noEventCell);
        scheduleBody.appendChild(row);
    } else {
        todayEvents.forEach(event => {
            const row = document.createElement('tr');
            const dateCell = document.createElement('td');
            const eventCell = document.createElement('td');

            dateCell.textContent = event.date;
            eventCell.textContent = event.event;

            row.appendChild(dateCell);
            row.appendChild(eventCell);
            scheduleBody.appendChild(row);
        });
    }
}


function updateCurrentDatetime() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
    currentDatetimeDisplay.textContent = now.toLocaleString('default', options);
}

prevMonthButton.addEventListener('click', () => {
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    currentYear = (currentMonth === 11) ? currentYear - 1 : currentYear;
    updateCalendar(currentMonth, currentYear);
});

nextMonthButton.addEventListener('click', () => {
    currentMonth = (currentMonth === 11) ? 0 : currentMonth + 1;
    currentYear = (currentMonth === 0) ? currentYear + 1 : currentYear;
    updateCalendar(currentMonth, currentYear);
});

scheduleButton.addEventListener('click', () => {
    modal.style.display = 'flex';
});

closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

scheduleForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const date = eventDateInput.value;
    const eventName = eventNameInput.value.trim().toLowerCase();
    const currentDate = new Date();
    const selectedDate = new Date(date);

    if (date && eventName) {
        if (selectedDate < currentDate.setHours(0, 0, 0, 0)) {
            alert('Cannot schedule events in the past.');
            return;
        }

        if (scheduledDates.some(event => event.date === date && event.event.toLowerCase() === eventName)) {
            alert('An event with the same name is already scheduled on this date.');
            return;
        }

        scheduledDates.push({ date, event: eventName });
        updateCalendar(currentMonth, currentYear);
        updateScheduleTable();
        modal.style.display = 'none';
        scheduleForm.reset();
    }
});

document.querySelector('.close-details').addEventListener('click', () => {
    eventDetailsModal.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === eventDetailsModal) {
        eventDetailsModal.style.display = 'none';
    }
});


function updateMonthlyEvents(month, year) {
    eventsBody.innerHTML = '';
    const firstDayOfMonth = new Date(year, month, 1);
    const lastDayOfMonth = new Date(year, month + 1, 0);
    const monthEvents = scheduledDates.filter(event => {
        const eventDate = new Date(event.date);
        return eventDate >= firstDayOfMonth && eventDate <= lastDayOfMonth;
    });

    if (monthEvents.length === 0) {
        const row = document.createElement('tr');
        const noEventCell = document.createElement('td');
        noEventCell.textContent = 'No events scheduled for this month.';
        noEventCell.colSpan = 2; // Ensure the cell spans both date and event columns
        row.appendChild(noEventCell);
        eventsBody.appendChild(row);
    } else {
        monthEvents.forEach(event => {
            const row = document.createElement('tr');
            const dateCell = document.createElement('td');
            const eventCell = document.createElement('td');

            dateCell.textContent = event.date;
            eventCell.textContent = event.event;

            row.appendChild(dateCell);
            row.appendChild(eventCell);
            eventsBody.appendChild(row);
        });
    }

    monthYearEvents.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;
}

prevMonthEventsButton.addEventListener('click', () => {
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    currentYear = (currentMonth === 11) ? currentYear - 1 : currentYear;
    updateMonthlyEvents(currentMonth, currentYear);
});

nextMonthEventsButton.addEventListener('click', () => {
    currentMonth = (currentMonth === 11) ? 0 : currentMonth + 1;
    currentYear = (currentMonth === 0) ? currentYear + 1 : currentYear;
    updateMonthlyEvents(currentMonth, currentYear);
});

updateCalendar(currentMonth, currentYear);
updateScheduleTable();
updateMonthlyEvents(currentMonth, currentYear);
setInterval(updateCurrentDatetime, 1000);
updateCurrentDatetime();
