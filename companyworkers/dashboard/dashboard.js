// Toggle Sidebar for Mobile
 document.addEventListener('DOMContentLoaded', function() {
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  
  sidebarToggle.addEventListener('click', function() {
      sidebar.classList.toggle('open');
      overlay.classList.toggle('active');
  });
  
  overlay.addEventListener('click', function() {
      sidebar.classList.remove('open');
      overlay.classList.remove('active');
  });
  
  // Current Date and Time
  function updateDateTime() {
      const now = new Date();
      const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      document.getElementById('current-date').textContent = now.toLocaleDateString('en-US', dateOptions);
      
      let hours = now.getHours();
      const minutes = now.getMinutes().toString().padStart(2, '0');
      const ampm = hours >= 12 ? 'PM' : 'AM';
      hours = hours % 12;
      hours = hours ? hours : 12;
      
      document.getElementById('current-time').textContent = `${hours}:${minutes} ${ampm}`;
  }

      // Date/time display
      function updateDateTime() {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
        document.getElementById('currentTime').textContent = now.toLocaleTimeString('en-US', {
          hour: '2-digit',
          minute: '2-digit'
        });
      }
      document.addEventListener('DOMContentLoaded', function() {
        updateDateTime();
        setInterval(updateDateTime, 60000);
      });
  
  // Initialize Date and Time
  updateDateTime();
  // Update every minute
  setInterval(updateDateTime, 60000);
  
  // Calendar Implementation
  function generateCalendar() {
      const today = new Date();
      const currentMonth = today.getMonth();
      const currentYear = today.getFullYear();
      const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
      
      // First day of month
      const firstDay = new Date(currentYear, currentMonth, 1).getDay();
      
      // Last day of previous month
      const prevMonthLastDay = new Date(currentYear, currentMonth, 0).getDate();
      
      const calendarDays = document.getElementById('calendar-days');
      calendarDays.innerHTML = '';
      
      // Day names
      const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
      dayNames.forEach(day => {
          const dayNameElement = document.createElement('div');
          dayNameElement.className = 'day-name';
          dayNameElement.textContent = day;
          calendarDays.appendChild(dayNameElement);
      });
      
      // Previous month days
      for (let i = firstDay - 1; i >= 0; i--) {
          const day = document.createElement('div');
          day.className = 'day other-month';
          day.textContent = prevMonthLastDay - i;
          calendarDays.appendChild(day);
      }
      
      // Current month days
      for (let i = 1; i <= daysInMonth; i++) {
          const day = document.createElement('div');
          day.className = 'day';
          if (i === today.getDate()) {
              day.classList.add('today');
          }
          day.textContent = i;
          calendarDays.appendChild(day);
      }
      
      // Next month days
      const totalCells = 42; // 6 rows * 7 columns
      const cellsFilled = firstDay + daysInMonth;
      const cellsToFill = totalCells - cellsFilled;
      
      for (let i = 1; i <= cellsToFill; i++) {
          const day = document.createElement('div');
          day.className = 'day other-month';
          day.textContent = i;
          calendarDays.appendChild(day);
      }
  }

  // Initialize Calendar
  generateCalendar();
  
  // Add click events to menu items
  const menuItems = document.querySelectorAll('.menu-item');
  menuItems.forEach(item => {
      item.addEventListener('click', function(e) {
          // Only handle mobile sidebar closing
          if (window.innerWidth <= 768) {
              sidebar.classList.remove('open');
              overlay.classList.remove('active');
          }
      });
  });
});


       // --- Metrics AJAX update ---
       function fetchMetricsByDate(dateStr) {
        // Show loading indicator
        document.getElementById('metric-appointments').textContent = '...';
        document.getElementById('metric-contactforums').textContent = '...';
        document.getElementById('metric-acceptedclients').textContent = '...';

        fetch('dashboard.php?fetch_metrics_by_date=1&date=' + encodeURIComponent(dateStr))
            .then(res => {
                if (!res.ok) throw new Error('Network response was not ok');
                return res.json();
            })
            .then(data => {
                // Debug: log the data
                console.log('Metrics for', dateStr, data);

                document.getElementById('metric-appointments').textContent = data.appointments;
                document.getElementById('metric-contactforums').textContent = data.contactforums;
                document.getElementById('metric-acceptedclients').textContent = data.accepted_clients;
                document.getElementById('metric-appointments-change').textContent = '';
                document.getElementById('metric-contactforums-change').textContent = '';
                document.getElementById('metric-acceptedclients-change').textContent = '';
                document.getElementById('metric-appointments-footer').textContent = 'Selected date: ' + dateStr;
                document.getElementById('metric-contactforums-footer').textContent = 'Selected date: ' + dateStr;
                document.getElementById('metric-acceptedclients-footer').textContent = 'Selected date: ' + dateStr;
            })
            .catch(err => {
                // Debug: log the error
                console.error('Error fetching metrics:', err);
                document.getElementById('metric-appointments').textContent = '!';
                document.getElementById('metric-contactforums').textContent = '!';
                document.getElementById('metric-acceptedclients').textContent = '!';
            });
    }

    // --- Calendar navigation and rendering for all months/years ---
    let calendarYear, calendarMonth;
    let selectedDayElement = null;
    let lastSelectedDateStr = null; // Track last selected date string

    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        calendarYear = today.getFullYear();
        calendarMonth = today.getMonth();
        renderCalendar(calendarYear, calendarMonth);

        // Fetch metrics for today on load
        lastSelectedDateStr = today.toISOString().slice(0,10);
        fetchMetricsByDate(lastSelectedDateStr);

        document.getElementById('calendar-prev').onclick = function() {
            calendarMonth--;
            if (calendarMonth < 0) {
                calendarMonth = 11;
                calendarYear--;
            }
            renderCalendar(calendarYear, calendarMonth);
        };
        document.getElementById('calendar-next').onclick = function() {
            calendarMonth++;
            if (calendarMonth > 11) {
                calendarMonth = 0;
                calendarYear++;
            }
            renderCalendar(calendarYear, calendarMonth);
        };

        // --- Auto-refresh logic ---
        setInterval(function() {
            // Use last selected date or today if not set
            let dateStr = lastSelectedDateStr;
            if (!dateStr) {
                const now = new Date();
                dateStr = now.toISOString().slice(0,10);
            }
            fetchMetricsByDate(dateStr);
        }, 30000); // 30 seconds
    });

    function renderCalendar(year, month) {
        const monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];
        document.getElementById('calendar-month').textContent = `${monthNames[month]} ${year}`;
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysContainer = document.getElementById('calendar-days');
        daysContainer.innerHTML = '';

        // Add empty cells for days before the first of the month
        for (let i = 0; i < firstDay.getDay(); i++) {
            const emptyDay = document.createElement('div');
            emptyDay.className = 'calendar-day empty';
            daysContainer.appendChild(emptyDay);
        }

        // Add days of the month
        const today = new Date();
        for (let i = 1; i <= lastDay.getDate(); i++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            if (
                year === today.getFullYear() &&
                month === today.getMonth() &&
                i === today.getDate()
            ) {
                dayElement.classList.add('today');
            }
            dayElement.textContent = i;
            dayElement.tabIndex = 0; // Make focusable for accessibility

            // Add click event to fetch metrics for this date and highlight selection
            dayElement.onclick = function() {
                // Remove previous selection
                if (selectedDayElement) {
                    selectedDayElement.classList.remove('selected');
                }
                dayElement.classList.add('selected');
                selectedDayElement = dayElement;

                const mm = (month+1).toString().padStart(2,'0');
                const dd = i.toString().padStart(2,'0');
                const dateStr = `${year}-${mm}-${dd}`;
                // Debug: log the selected date
                console.log('Selected date:', dateStr);
                lastSelectedDateStr = dateStr; // Update last selected date
                fetchMetricsByDate(dateStr);
            };

            daysContainer.appendChild(dayElement);
        }

        // Clear selection highlight when month changes
        selectedDayElement = null;
    }

    function updateDateTime() {
        const now = new Date();
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        document.getElementById('current-date').textContent = `${days[now.getDay()]}, ${months[now.getMonth()]} ${now.getDate()}, ${now.getFullYear()}`;
        document.getElementById('current-time').textContent = now.toLocaleTimeString();
    }

    // --- Recent Activity AJAX update ---
    function fetchRecentActivity() {
        fetch('dashboard.php?fetch_recent_activity=1')
            .then(res => {
                if (!res.ok) throw new Error('Network response was not ok');
                return res.text();
            })
            .then(html => {
                const feed = document.querySelector('.activity-feed');
                if (feed) feed.innerHTML = html;
            })
            .catch(err => {
                console.error('Error fetching recent activity:', err);
            });
    }

    // --- Auto-refresh logic for metrics and activity ---
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        calendarYear = today.getFullYear();
        calendarMonth = today.getMonth();
        renderCalendar(calendarYear, calendarMonth);

        // Fetch metrics for today on load
        lastSelectedDateStr = today.toISOString().slice(0,10);
        fetchMetricsByDate(lastSelectedDateStr);

        document.getElementById('calendar-prev').onclick = function() {
            calendarMonth--;
            if (calendarMonth < 0) {
                calendarMonth = 11;
                calendarYear--;
            }
            renderCalendar(calendarYear, calendarMonth);
        };
        document.getElementById('calendar-next').onclick = function() {
            calendarMonth++;
            if (calendarMonth > 11) {
                calendarMonth = 0;
                calendarYear++;
            }
            renderCalendar(calendarYear, calendarMonth);
        };

        // --- Auto-refresh logic ---
        setInterval(function() {
            // Use last selected date or today if not set
            let dateStr = lastSelectedDateStr;
            if (!dateStr) {
                const now = new Date();
                dateStr = now.toISOString().slice(0,10);
            }
            fetchMetricsByDate(dateStr);
            fetchRecentActivity();
        }, 30000); // 30 seconds

        // Fetch recent activity on load
        fetchRecentActivity();
    });