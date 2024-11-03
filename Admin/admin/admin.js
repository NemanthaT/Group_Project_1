//Toggle content visibility
document.getElementById("arrow").addEventListener("click", function() {
    var content = document.getElementById("content");
    var arrow = document.getElementById("arrow");
    if (content.style.display === "none") {
        content.style.display = "block";
    } else {
        content.style.display = "none";
    }
    //arrow.style.transform="rotate(180deg)";
});

//Calendar
const calendarDays = document.getElementById("calendar-days");
const monthYear = document.getElementById("month-year");
const prevMonthButton = document.getElementById("prev-month");
const nextMonthButton = document.getElementById("next-month");

let currentDate = new Date();

function renderCalendar(date) {
    const month = date.getMonth();
    const year = date.getFullYear();
    monthYear.textContent = date.toLocaleString("default", { month: "long" }) + " " + year;
    
    calendarDays.innerHTML = "";

    const firstDay = new Date(year, month, 1).getDay() || 7;
    const lastDate = new Date(year, month + 1, 0).getDate();
    
    // Fill in the blank days before the 1st
    for (let i = 1; i < firstDay; i++) {
        const emptyDay = document.createElement("span");
        calendarDays.appendChild(emptyDay);
    }

    // Add days of the month
    for (let day = 1; day <= lastDate; day++) {
        const dayElement = document.createElement("span");
        dayElement.textContent = day;
        
        // Highlight today's date
        if (
            day === currentDate.getDate() &&
            month === currentDate.getMonth() &&
            year === currentDate.getFullYear()
        ) {
            dayElement.classList.add("today");
        }

        calendarDays.appendChild(dayElement);
    }
}

function changeMonth(direction) {
    currentDate.setMonth(currentDate.getMonth() + direction);
    renderCalendar(currentDate);
}

prevMonthButton.addEventListener("click", () => changeMonth(-1));
nextMonthButton.addEventListener("click", () => changeMonth(1));

renderCalendar(currentDate);