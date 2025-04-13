function filterAndSortAppointments() {
    const searchValue = document.getElementById("clientFilter").value.trim().toLowerCase()
    const appointmentDateFilter = document.getElementById("appointmentDateFilter")
      ? document.getElementById("appointmentDateFilter").value
      : "" // Corrected ID
    const statusSortValue = document.getElementById("statusSort")
      ? document.getElementById("statusSort").value.toLowerCase()
      : ""
  
    const tbody = document.getElementById("appointment-tbody")
    const rows = Array.from(tbody.querySelectorAll("tr"))
  
    rows.forEach((row) => {
      const appointmentIDCell = row.children[0]?.textContent.trim().toLowerCase()
      const clientIDCell = row.children[1]?.textContent.trim().toLowerCase()
      const appointmentDateCell = row.children[2]?.textContent.trim()
      const statusCell = row.children[3]?.textContent.trim().toLowerCase()
  
      let showRow = true
  
      //Filter by Appointment ID or Client ID
      if (searchValue && !(appointmentIDCell.includes(searchValue) || clientIDCell.includes(searchValue))) {
        showRow = false
      }
  
      //Filter by Appointment Date
      if (appointmentDateFilter && appointmentDateCell) {
        const rowDate = new Date(appointmentDateCell).toISOString().split("T")[0] // Convert row date to YYYY-MM-DD
        if (rowDate !== appointmentDateFilter) {
          showRow = false
        }
      }
  
      //Filter by Status
      if (statusSortValue && statusCell !== statusSortValue) {
        showRow = false
      }
  
      row.style.display = showRow ? "" : "none"
    })
  
    //Sort by Status (if applicable)
    if (statusSortValue) {
      rows.sort((a, b) => {
        const statusA = a.children[3]?.textContent.trim().toLowerCase()
        const statusB = b.children[3]?.textContent.trim().toLowerCase()
        return statusA.localeCompare(statusB)
      })
  
      // Re-append sorted rows
      tbody.innerHTML = ""
      rows.forEach((row) => tbody.appendChild(row))
    }
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
  
  