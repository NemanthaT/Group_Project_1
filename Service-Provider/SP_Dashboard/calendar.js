// // calendar.js

// let currentDate = new Date();
// const today = new Date(); // Stores today's date

// function renderCalendar() {
//     const monthYear = document.getElementById('monthYear');
//     const dates = document.getElementById('dates');

//     // Set the current month and year
//     const month = currentDate.getMonth();
//     const year = currentDate.getFullYear();
//     monthYear.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });

//     // Clear previous dates
//     dates.innerHTML = '';

//     // Get the first day of the month
//     const firstDayOfMonth = new Date(year, month, 1).getDay();
//     const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
//     const lastDateOfPrevMonth = new Date(year, month, 0).getDate();

//     // Add previous month's dates
//     for (let i = firstDayOfMonth; i > 0; i--) {
//         const date = document.createElement('div');
//         date.classList.add('date', 'other-month');
//         date.textContent = lastDateOfPrevMonth - i + 1;
//         dates.appendChild(date);
//     }

//     // Add current month's dates
//     for (let i = 1; i <= lastDateOfMonth; i++) {
//         const date = document.createElement('div');
//         date.classList.add('date');
//         date.textContent = i;

//         // Highlight today
//         if (
//             year === today.getFullYear() &&
//             month === today.getMonth() &&
//             i === today.getDate()
//         ) {
//             date.classList.add('today');
//         }

//         dates.appendChild(date);
//     }

//     // Calculate the remaining cells after the last date of the month
//     const remainingCells = 42 - (firstDayOfMonth + lastDateOfMonth);

//     // Add next month's dates
//     for (let i = 1; i <= remainingCells; i++) {
//         const date = document.createElement('div');
//         date.classList.add('date', 'other-month');
//         date.textContent = i;
//         dates.appendChild(date);
//     }
// }

// function prevMonth() {
//     currentDate.setMonth(currentDate.getMonth() - 1);
//     renderCalendar();
// }

// function nextMonth() {
//     currentDate.setMonth(currentDate.getMonth() + 1);
//     renderCalendar();
// }

// // Initial calendar render
// renderCalendar();

//clock
// Calling showTime function at every second
setInterval(showTime, 1000);

// Defining showTime funcion
function showTime() {
    // Getting current time and date
    let time = new Date();
    let hour = time.getHours();
    let min = time.getMinutes();
    let sec = time.getSeconds();
    am_pm = "AM";

    // Setting time for 12 Hrs format
    if (hour >= 12) {
        if (hour > 12) hour -= 12;
        am_pm = "PM";
    } else if (hour == 0) {
        hr = 12;
        am_pm = "AM";
    }

    hour =
        hour < 10 ? "0" + hour : hour;
    min = min < 10 ? "0" + min : min;
    sec = sec < 10 ? "0" + sec : sec;

    let currentTime =
        hour +
        ":" +
        min +
        ":" +
        sec +
        am_pm;

    // Displaying the time
    document.getElementById(
        "time"
    ).innerHTML = currentTime;
}

showTime();
