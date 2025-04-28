    document.addEventListener("DOMContentLoaded", () => {
        const calendarToggle = document.getElementById("calendarToggle")
        const calendarDropdown = document.getElementById("calendarDropdown")
        const daysGrid = document.getElementById("daysGrid")
        const currentMonthElement = document.getElementById("currentMonth")
        const prevMonthButton = document.getElementById("prevMonth")
        const nextMonthButton = document.getElementById("nextMonth")
    
        const currentDate = new Date()
        const selectedDate = new Date()
    
        function renderCalendar() {
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
    
        renderCalendar()
    })