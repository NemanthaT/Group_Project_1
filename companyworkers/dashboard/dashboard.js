let currentDate = new Date();
const today = new Date(); // Stores today's date
const dateCounts = {}; // To store counts for each clicked date

// Function to generate a random letter count (two digits)
function generateRandomLetterCount() {
  return Math.floor(Math.random() * 100); // Random number between 0 and 99 (two digits)
}

// Function to update the counter and date display
function updateCounter(date) {
  const dateText = `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')}`;

  // Display the date in the format Year-Month-Day
  document.getElementById('dateDisplay').textContent = `Letters received on ${dateText}:`;

  // If the date has been clicked before, use the stored count, else generate a new count
  if (!dateCounts[dateText]) {
    dateCounts[dateText] = generateRandomLetterCount();
  }

  const letterCount = dateCounts[dateText];

  // Split the number into individual digits
  const digits = letterCount.toString().padStart(2, '0').split('');

  // Update the flip-clock display with the new digits
  document.getElementById('digit1').textContent = digits[0];
  document.getElementById('digit2').textContent = digits[1];
}

// Calendar functionality to navigate between months
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
    if (year === today.getFullYear() && month === today.getMonth() && i === today.getDate()) {
      date.classList.add('today');
    }

    // Attach an event listener to update the counter when a date is clicked
    date.addEventListener('click', function () {
      const clickedDate = new Date(year, month, i);
      updateCounter(clickedDate);
    });

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

// Initial rendering
renderCalendar();

// Set initial counter to today's date
updateCounter(today);

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