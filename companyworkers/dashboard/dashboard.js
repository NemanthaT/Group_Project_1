let currentDate = new Date();
const today = new Date();

function renderCalendar() {
    const monthYear = document.getElementById('monthYear');
    const dates = document.getElementById('dates');

    const month = currentDate.getMonth();
    const year = currentDate.getFullYear();
    monthYear.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });

    dates.innerHTML = '';

    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
    const lastDateOfPrevMonth = new Date(year, month, 0).getDate();

    for (let i = firstDayOfMonth; i > 0; i--) {
        const date = document.createElement('div');
        date.classList.add('date', 'other-month');
        date.textContent = lastDateOfPrevMonth - i + 1;
        dates.appendChild(date);
    }

    for (let i = 1; i <= lastDateOfMonth; i++) {
        const date = document.createElement('div');
        date.classList.add('date');
        date.textContent = i;

        if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
            date.classList.add('today');
        }

        dates.appendChild(date);
    }

    const remainingCells = 42 - (firstDayOfMonth + lastDateOfMonth);
    for (let i = 1; i <= remainingCells; i++) {
        const date = document.createElement('div');
        date.classList.add('date', 'other-month');
        date.textContent = i;
        dates.appendChild(date);
    }
}

function prevMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

renderCalendar();

function updateClock() {
    const now = new Date();
    const options = { timeZone: 'Asia/Colombo', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
    document.getElementById('clock').textContent = now.toLocaleTimeString('en-GB', options);
}
setInterval(updateClock, 1000);
updateClock();

function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
}

let count = 0;
function updateCounter() {
    document.getElementById('counter').textContent = count;
}
function incrementCounter() {
    count++;
    updateCounter();
}
function decrementCounter() {
    count--;
    updateCounter();
}
function resetCounter() {
    count = 0;
    updateCounter();
}

function updateDateDisplay() {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const day = String(currentDate.getDate()).padStart(2, '0');
    document.getElementById('date-display').textContent = `${year}-${month}-${day}`;
}
updateDateDisplay();
