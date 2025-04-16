function filterAndSortAppointments() {
  const appointmentIDFilter = document.getElementById("clientFilter").value.trim().toLowerCase();
  const appointmentDateFilter = document.getElementById("appointmentDateFilter")?.value || "";
  const statusFilter = document.getElementById("statusSort")?.value.toLowerCase() || "";

  const tbody = document.getElementById("appointment-tbody");
  const rows = Array.from(tbody.querySelectorAll("tr"));

  rows.forEach((row) => {
    const appointmentIDCell = row.children[0]?.textContent.trim().toLowerCase(); // Appointment ID
    const appointmentDateCell = row.children[1]?.textContent.trim(); // Appointment Date
    const statusCell = row.children[2]?.textContent.trim().toLowerCase(); // Status

    let showRow = true;

    // Filter by Appointment ID only
    if (appointmentIDFilter && !appointmentIDCell.includes(appointmentIDFilter)) {
      showRow = false;
    }

    // Filter by Appointment Date only
    if (appointmentDateFilter && appointmentDateCell) {
      // Extract only the date part from the cell
      const rowDate = appointmentDateCell.split(" ")[0]; // Takes "2024-11-25" from "2024-11-25 10:00:00"
      
      if (rowDate !== appointmentDateFilter) {
        showRow = false;
      }
    }

    // Filter by Status only
    if (statusFilter && statusCell !== statusFilter) {
      showRow = false;
    }

    row.style.display = showRow ? "" : "none";
  });
}

  
  function clearFilters() {
    document.getElementById("clientFilter").value = ""
    document.getElementById("appointmentDateFilter").value = ""
    document.getElementById("statusSort").value = ""
  
    filterAndSortAppointments() // Reapply filtering to reset the table
  }
  
  //Calendar
  document.addEventListener("DOMContentLoaded", () => {
    const calendarToggle = document.getElementById("calendarToggle")
    const calendarDropdown = document.getElementById("calendarDropdown")
    const daysGrid = document.getElementById("daysGrid")
    const currentMonthElement = document.getElementById("currentMonth")
    const prevMonthButton = document.getElementById("prevMonth")
    const nextMonthButton = document.getElementById("nextMonth")
  
    const currentDate = new Date()
    const selectedDate = new Date()
  
    function handleDateClick(date, appointmentId) {
      if (appointmentId) {
        window.location.href = "ViewApp.php?id=" + appointmentId
      }
    }
  
   /////Read//////////// Function to fetch appointment dates from the table rows
    function fetchAppointmentDates() {
      const appointmentRows = document.querySelectorAll(".appointment-table tbody tr")
      const dates = []
  
      appointmentRows.forEach((row) => {
        const dateStr = row.getAttribute("data-appointment-date")
        const appointmentId = row.getAttribute("data-appointment-id")
        if (dateStr && appointmentId) {
          const date = new Date(dateStr)
          if (!isNaN(date.getTime())) {
            dates.push({ date: date, id: appointmentId })
          }
        }
      })
  
      return dates
    }
  
    function renderCalendar() {
      const events = fetchAppointmentDates()
  
      const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1)
      const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0)
  
      currentMonthElement.textContent = currentDate.toLocaleString("default", {
        month: "long",
        year: "numeric",
      })
  
      daysGrid.innerHTML = ""
  
      let dayOfWeek = firstDay.getDay()
      dayOfWeek = dayOfWeek === 0 ? 6 : dayOfWeek - 1
  
      for (let i = 0; i < dayOfWeek; i++) {
        daysGrid.appendChild(document.createElement("div"))
      }
  
      for (let day = 1; day <= lastDay.getDate(); day++) {
        const dayElement = document.createElement("div")
        dayElement.textContent = day
  
        const currentDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), day)
  
        const matchingEvents = events.filter(
          (event) =>
            event.date.getDate() === currentDay.getDate() &&
            event.date.getMonth() === currentDay.getMonth() &&
            event.date.getFullYear() === currentDay.getFullYear(),
        )
  
        if (matchingEvents.length > 0) {
          dayElement.classList.add("has-event")
          dayElement.style.cursor = "pointer"
          dayElement.onclick = () => {
            // If there are multiple appointments on the same day, you might want to
            // show a list of appointments or just use the first one
            handleDateClick(currentDay, matchingEvents[0].id)
          }
        }
  
        if (
          day === selectedDate.getDate() &&
          currentDate.getMonth() === selectedDate.getMonth() &&
          currentDate.getFullYear() === selectedDate.getFullYear()
        ) {
          dayElement.classList.add("today")
        }
  
        daysGrid.appendChild(dayElement)
      }
    }
  
    // Event Listeners
    calendarToggle.addEventListener("click", (e) => {
      e.preventDefault()
      calendarDropdown.style.display = "block"
      renderCalendar()
    })
  
    document.addEventListener("click", (e) => {
      let targetElement = e.target
      let isCalendarArea = false
  
      while (targetElement != null) {
        if (
          targetElement.classList &&
          (targetElement.classList.contains("calendar-dropdown") || targetElement.classList.contains("calendar-icon"))
        ) {
          isCalendarArea = true
          break
        }
        targetElement = targetElement.parentElement
      }
  
      if (!isCalendarArea && e.target !== calendarToggle) {
        calendarDropdown.style.display = "none"
      }
    })
  
    prevMonthButton.addEventListener("click", () => {
      currentDate.setMonth(currentDate.getMonth() - 1)
      renderCalendar()
    })
  
    nextMonthButton.addEventListener("click", () => {
      currentDate.setMonth(currentDate.getMonth() + 1)
      renderCalendar()
    })
  
    // Initial render
    renderCalendar()
  })
  
  