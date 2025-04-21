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