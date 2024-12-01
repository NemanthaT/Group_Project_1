let currentDate = new Date();
const today = new Date();

// Function to generate a random count for the counter
function updateCounter(date, counterId) {
  const dateDisplay = document.getElementById('dateDisplay' + counterId);
  const counterDigit1 = document.getElementById('counter' + counterId + '_digit1');
  const counterDigit2 = document.getElementById('counter' + counterId + '_digit2');

  // Set the date display in the format YYYY-MM-DD
  const formattedDate = date.toISOString().split('T')[0];
  
  // Get the custom name for the counter
  const customName = dateDisplay.getAttribute('data-name') || `Letters received on`;  // Default to "Letters received on"
  
  dateDisplay.textContent = `${customName} ${formattedDate}:`;

  // Generate a random count (just an example, different for each counter)
  const randomCount = Math.floor(Math.random() * 100); // Random number between 0 and 99

  // Split the count into two digits for display
  const countString = randomCount.toString().padStart(2, '0');
  counterDigit1.textContent = countString[0];
  counterDigit2.textContent = countString[1];
}

// Function to update the current date counter by default
function updateCurrentDateCounter() {
  updateCounter(today, 1);  // For the current day, default counter 1
  updateCounter(today, 2);  // For the current day, default counter 2
  updateCounter(today, 3);  // For the current day, default counter 3
  updateCounter(today, 4);  // For the current day, default counter 4
  updateCounter(today, 5);  // For the current day, default counter 5
}

// Initial update of counters
updateCurrentDateCounter();

// Calendar functions to render the calendar
function renderCalendar() {
  const monthYear = document.getElementById('monthYear');
  const dates = document.getElementById('dates');

  const month = currentDate.getMonth();
  const year = currentDate.getFullYear();
  monthYear.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });

  dates.innerHTML = '';

  const firstDayOfMonth = new Date(year, month, 1).getDay();
  const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
  const lastDateOfPrevMonth = new Date(year, month, 0).getDate();

  for (let i = firstDayOfMonth; i > 0; i--) {
    const date = document.createElement('div');
    date.classList.add('date', 'other-month');
    date.textContent = lastDateOfPrevMonth - i + 1;
    dates.appendChild(date);
  }

  for (let i = 1; i <= lastDateOfMonth; i++) {
    const date = document.createElement('div');
    date.classList.add('date');
    date.textContent = i;

    date.addEventListener('click', function() {
      const clickedDate = new Date(year, month, i);
      updateCounter(clickedDate, 1);  // Update counter 1 for clicked date
      updateCounter(clickedDate, 2);  // Update counter 2 for clicked date
      updateCounter(clickedDate, 3);  // Update counter 3 for clicked date
      updateCounter(clickedDate, 4);  // Update counter 4 for clicked date
      updateCounter(clickedDate, 5);  // Update counter 5 for clicked date
    });

    dates.appendChild(date);
  }

  const remainingCells = 42 - (firstDayOfMonth + lastDateOfMonth);
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

//dateeeeeeeeeeeee

function updateDateDisplay() {
  const dateDisplay = document.getElementById('date-display');

  // Get the current date
  const currentDate = new Date();

  // Format the date as YYYY-MM-DD
  const year = currentDate.getFullYear();
  const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
  const day = String(currentDate.getDate()).padStart(2, '0');

  // Set the date in the format YYYY-MM-DD
  dateDisplay.textContent = `${year}-${month}-${day}`;
}

// Update the date display on page load
updateDateDisplay();
