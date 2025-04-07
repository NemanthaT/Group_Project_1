function filterAndSortAppointments() {
    const searchValue = document.getElementById("clientFilter").value.trim().toLowerCase();
    const appointmentDateFilter = document.getElementById("appointmentDateFilter") ? document.getElementById("appointmentDateFilter").value : ""; // Corrected ID
    const statusSortValue = document.getElementById("statusSort") ? document.getElementById("statusSort").value.toLowerCase() : "";

    const tbody = document.getElementById("appointment-tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    rows.forEach(row => {
        const appointmentIDCell = row.children[0]?.textContent.trim().toLowerCase();
        const clientIDCell = row.children[1]?.textContent.trim().toLowerCase();
        const appointmentDateCell = row.children[2]?.textContent.trim(); 
        const statusCell = row.children[3]?.textContent.trim().toLowerCase();

        let showRow = true;

        //Filter by Appointment ID or Client ID
        if (searchValue && !(appointmentIDCell.includes(searchValue) || clientIDCell.includes(searchValue))) {
            showRow = false;
        }

        //Filter by Appointment Date
        if (appointmentDateFilter && appointmentDateCell) {
            const rowDate = new Date(appointmentDateCell).toISOString().split("T")[0]; // Convert row date to YYYY-MM-DD
            if (rowDate !== appointmentDateFilter) {
                showRow = false;
            }
        }

        //Filter by Status
        if (statusSortValue && statusCell !== statusSortValue) {
            showRow = false;
        }

        row.style.display = showRow ? "" : "none";
    });

    //Sort by Status (if applicable)
    if (statusSortValue) {
        rows.sort((a, b) => {
            const statusA = a.children[3]?.textContent.trim().toLowerCase();
            const statusB = b.children[3]?.textContent.trim().toLowerCase();
            return statusA.localeCompare(statusB);
        });

        // Re-append sorted rows
        tbody.innerHTML = "";
        rows.forEach(row => tbody.appendChild(row));
    }
}

function clearFilters() {
    document.getElementById("clientFilter").value = "";
    document.getElementById("appointmentDateFilter").value = "";
    document.getElementById("statusSort").value = "";

    filterAndSortAppointments(); // Reapply filtering to reset the table
}

//Calendar
document.addEventListener('DOMContentLoaded', function() {
    const calendarToggle = document.getElementById('calendarToggle');
    const calendarDropdown = document.getElementById('calendarDropdown');
    const daysGrid = document.getElementById('daysGrid');
    const currentMonthElement = document.getElementById('currentMonth');
    const prevMonthButton = document.getElementById('prevMonth');
    const nextMonthButton = document.getElementById('nextMonth');

    let currentDate = new Date();
    let selectedDate = new Date();

    // Sample events (you can replace this with your actual events)
    const events = [
        new Date(2025, 2, 2),
        new Date(2025, 2, 7),
        new Date(2025, 2, 10),
        new Date(2025, 2, 16)
    ];

    function renderCalendar() {
        const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
        const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
        
        // Update month display
        currentMonthElement.textContent = currentDate.toLocaleString('default', { 
            month: 'long', 
            year: 'numeric' 
        });

        // Clear previous days
        daysGrid.innerHTML = '';

        // Add empty cells for days before the first day of the month
        for (let i = 0; i < firstDay.getDay(); i++) {
            daysGrid.appendChild(document.createElement('div'));
        }

        // Add days of the month
        for (let day = 1; day <= lastDay.getDate(); day++) {
            const dayElement = document.createElement('div');
            dayElement.textContent = day;

            // Check if this day has an event
            const currentDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
            if (events.some(event => event.getTime() === currentDay.getTime())) {
                dayElement.classList.add('has-event');
            }

            // Check if this is today
            if (day === selectedDate.getDate() && 
                currentDate.getMonth() === selectedDate.getMonth() && 
                currentDate.getFullYear() === selectedDate.getFullYear()) {
                dayElement.classList.add('today');
            }

            daysGrid.appendChild(dayElement);
        }
    }

    // Event Listeners
    calendarToggle.addEventListener('click', function(e) {
        e.preventDefault();
        calendarDropdown.style.display = 'block';
    });

    document.addEventListener('mouseover', function(e) {
        let targetElement = e.target;
        let isCalendarArea = false;

        while (targetElement != null) {
            if (targetElement.classList && 
                (targetElement.classList.contains('calendar-dropdown') || 
                 targetElement.classList.contains('calendar-icon'))) {
                isCalendarArea = true;
                break;
            }
            targetElement = targetElement.parentElement;
        }

        if (!isCalendarArea) {
            calendarDropdown.style.display = 'none';
        }
    });

    prevMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthButton.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    // Initial render
    renderCalendar();
});