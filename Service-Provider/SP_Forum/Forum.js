// Function to search for topics in the forum
function searchTopics() {
    const query = document.getElementById("search-input").value.toLowerCase()
    const threads = document.querySelectorAll("#thread-list li")
    threads.forEach((thread) => {
      const title = thread.querySelector("h4").textContent.toLowerCase()
      if (title.includes(query)) {
        thread.style.display = ""
      } else {
        thread.style.display = "none"
      }
    })
  }
  
  // Function to filter threads by category
  function filterByCategory(category) {
    const threads = document.querySelectorAll("#thread-list li")
    threads.forEach((thread) => {
      if (category === "all" || thread.getAttribute("data-category") === category) {
        thread.style.display = ""
      } else {
        thread.style.display = "none"
      }
    })
  }
  
  // Function to display the modal with thread details
  function viewThread(title, content, views, replies) {
    // Populate the modal with thread details
    document.getElementById("modalTitle").textContent = title
    document.getElementById("modalContent").textContent = content
    document.getElementById("modalViews").textContent = views + " views"
    document.getElementById("modalReplies").textContent = replies + " replies"
  
    // Display the modal and overlay
    document.getElementById("modalOverlay").style.display = "block"
    document.getElementById("modalForm").style.display = "block"
  }
  
  // Function to close the modal
  function closeModal() {
    document.getElementById("modalForm").style.display = "none"
    document.getElementById("modalOverlay").style.display = "none"
  }
  
  // Function to open the "Create New Thread" modal
  function openCreateThreadModal() {
    document.getElementById("createThreadModalOverlay").style.display = "block"
    document.getElementById("createThreadModal").style.display = "block"
  }
  
  // Function to close the "Create New Thread" modal
  function closeCreateThreadModal() {
    document.getElementById("createThreadModalOverlay").style.display = "none"
    document.getElementById("createThreadModal").style.display = "none"
  }
  
  // Calendar functionality
  document.addEventListener("DOMContentLoaded", () => {
    // Calendar toggle
    const calendarToggle = document.getElementById("calendarToggle")
    const calendarDropdown = document.getElementById("calendarDropdown")
  
    if (calendarToggle && calendarDropdown) {
      calendarToggle.addEventListener("click", (e) => {
        e.preventDefault()
        if (calendarDropdown.style.display === "block") {
          calendarDropdown.style.display = "none"
        } else {
          calendarDropdown.style.display = "block"
          renderCalendar(new Date())
        }
      })
  
      // Close calendar when clicking outside
      document.addEventListener("click", (e) => {
        if (!calendarToggle.contains(e.target) && !calendarDropdown.contains(e.target)) {
          calendarDropdown.style.display = "none"
        }
      })
    }
  
    // Calendar navigation
    const prevMonth = document.getElementById("prevMonth")
    const nextMonth = document.getElementById("nextMonth")
    const currentDate = new Date()
  
    if (prevMonth && nextMonth) {
      prevMonth.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() - 1)
        renderCalendar(currentDate)
      })
  
      nextMonth.addEventListener("click", () => {
        currentDate.setMonth(currentDate.getMonth() + 1)
        renderCalendar(currentDate)
      })
    }
  
    // Render calendar function
    function renderCalendar(date) {
      const currentMonth = document.getElementById("currentMonth")
      const daysGrid = document.getElementById("daysGrid")
  
      if (!currentMonth || !daysGrid) return
  
      const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ]
      const year = date.getFullYear()
      const month = date.getMonth()
  
      currentMonth.textContent = `${months[month]} ${year}`
  
      // Clear previous days
      daysGrid.innerHTML = ""
  
      // Get first day of month and total days
      const firstDay = new Date(year, month, 1).getDay()
      const daysInMonth = new Date(year, month + 1, 0).getDate()
  
      // Adjust for Monday as first day of week (0 = Monday, 6 = Sunday)
      const startDay = firstDay === 0 ? 6 : firstDay - 1
  
      // Add empty cells for days before start of month
      for (let i = 0; i < startDay; i++) {
        const emptyDay = document.createElement("div")
        daysGrid.appendChild(emptyDay)
      }
  
      // Add days of month
      const today = new Date()
      for (let i = 1; i <= daysInMonth; i++) {
        const dayElement = document.createElement("div")
        dayElement.textContent = i
  
        // Highlight today
        if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
          dayElement.classList.add("today")
        }
  
        daysGrid.appendChild(dayElement)
      }
    }
  })
  