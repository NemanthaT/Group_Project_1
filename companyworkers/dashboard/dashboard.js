let currentDate = new Date();
      const today = new Date(); // Stores today's date
  
      function renderCalendar() {
          const monthYear = document.getElementById('monthYear');
          const dates = document.getElementById('dates');
  
          // Set the current month and year
          const month = currentDate.getMonth();
          const year = currentDate.getFullYear();
          monthYear.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
  
          // Clear previous dates
          dates.innerHTML = '';
  
          // Get the first day of the month
          const firstDayOfMonth = new Date(year, month, 1).getDay();
          const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
          const lastDateOfPrevMonth = new Date(year, month, 0).getDate();
  
          // Add previous month's dates
          for (let i = firstDayOfMonth; i > 0; i--) {
              const date = document.createElement('div');
              date.classList.add('date', 'other-month');
              date.textContent = lastDateOfPrevMonth - i + 1;
              dates.appendChild(date);
          }
  
          // Add current month's dates
          for (let i = 1; i <= lastDateOfMonth; i++) {
              const date = document.createElement('div');
              date.classList.add('date');
              date.textContent = i;
  
              // Highlight today
              if (
                  year === today.getFullYear() &&
                  month === today.getMonth() &&
                  i === today.getDate()
              ) {
                  date.classList.add('today');
              }
  
              dates.appendChild(date);
          }
  
          // Calculate the remaining cells after the last date of the month
          const remainingCells = 42 - (firstDayOfMonth + lastDateOfMonth);
  
          // Add next month's dates
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
  
      // Initial calendar render
      renderCalendar();

  // timeeeeeeeeeeeeeeeee
  
      function updateClock() {
          const now = new Date();

          // Convert to Sri Lanka time (UTC+5:30)
          const options = { timeZone: 'Asia/Colombo', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
          const sriLankaTime = now.toLocaleTimeString('en-GB', options);

          // Display time
          document.getElementById('clock').textContent = sriLankaTime ;
      }

      // Update clock every second
      setInterval(updateClock, 1000);

      // Initial call to display clock immediately
      updateClock();

      function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
      }