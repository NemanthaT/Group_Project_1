// Current date and time variables
let currentDate = new Date();
const today = new Date();

// DOM ready function
document.addEventListener('DOMContentLoaded', function () {
  // Adjust sidebar toggle to match new layout
  const menuToggle = document.querySelector('.menu-toggle');
  const sidebar = document.querySelector('.sidebar');

  if (menuToggle) {
    menuToggle.addEventListener('click', function () {
      sidebar.classList.toggle('collapsed');
      document.querySelector('.main-content').classList.toggle('expanded');
    });
  }

  // Initialize all dashboard components
  initializeDateTime();
  initializeCalendar();

  // Add active class to current menu item
  highlightCurrentPage();

  // Add animations to elements when they come into view
  animateOnScroll();
});

// Highlight the current page in navigation
function highlightCurrentPage() {
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll('.nav-menu li a');

  navLinks.forEach(link => {
    if (link.getAttribute('href') && currentPath.includes(link.getAttribute('href'))) {
      link.parentElement.classList.add('active');
    }
  });
}

// Initialize the date and time displays
function initializeDateTime() {
  updateTime();
  setInterval(updateTime, 1000);
  updateDateDisplay();
}

// Update the digital clock
function updateTime() {
  const now = new Date();
  const options = {
    timeZone: 'Asia/Colombo',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: false
  };
  const timeString = now.toLocaleTimeString('en-GB', options);

  const clockElement = document.getElementById('clock');
  if (clockElement) {
    clockElement.textContent = timeString;
  }
}

// Update the date display
function updateDateDisplay() {
  const dateDisplay = document.getElementById('current-date');
  if (dateDisplay) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    dateDisplay.textContent = today.toLocaleDateString('en-US', options);
  }
}

// Calendar functions
function renderCalendar() {
  const monthYear = document.getElementById('monthYear');
  const dates = document.getElementById('dates');

  if (!monthYear || !dates) return;

  const month = currentDate.getMonth();
  const year = currentDate.getFullYear();
  monthYear.textContent = currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });

  dates.innerHTML = '';

  const firstDayOfMonth = new Date(year, month, 1).getDay();
  const lastDateOfMonth = new Date(year, month + 1, 0).getDate();
  const lastDateOfPrevMonth = new Date(year, month, 0).getDate();

  // Previous month dates
  for (let i = firstDayOfMonth; i > 0; i--) {
    const date = createDateElement(lastDateOfPrevMonth - i + 1, true);
    dates.appendChild(date);
  }

  // Current month dates
  for (let i = 1; i <= lastDateOfMonth; i++) {
    const date = createDateElement(i, false);
    if (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
      date.classList.add('today');
    }
    dates.appendChild(date);
  }

  // Next month dates
  const remainingCells = 42 - (firstDayOfMonth + lastDateOfMonth);
  for (let i = 1; i <= remainingCells; i++) {
    const date = createDateElement(i, true);
    dates.appendChild(date);
  }
}

function createDateElement(day, isOtherMonth) {
  const date = document.createElement('div');
  date.classList.add('date');
  if (isOtherMonth) date.classList.add('other-month');
  date.textContent = day;

  // Add the data-date attribute
  const year = currentDate.getFullYear();
  const month = String(currentDate.getMonth() + 1).padStart(2, '0');
  const dayString = String(day).padStart(2, '0');
  date.setAttribute('data-date', `${year}-${month}-${dayString}`);

  if (!isOtherMonth) {
    date.addEventListener('click', function () {
      const clickedDate = date.getAttribute('data-date');
      fetchDataForDate(clickedDate);
    });
  }

  return date;
}

function prevMonth() {
  currentDate.setMonth(currentDate.getMonth() - 1);
  renderCalendar();
}

function nextMonth() {
  currentDate.setMonth(currentDate.getMonth() + 1);
  renderCalendar();
}

// Initialize calendar
function initializeCalendar() {
  renderCalendar();
}

// Animation on scroll
function animateOnScroll() {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  });

  document.querySelectorAll('.stat-card, .widget').forEach(el => {
    observer.observe(el);
  });
}

// Fetch data for the selected date
function fetchDataForDate(date) {
  fetch('dashboard.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: `selectedDate=${encodeURIComponent(date)}`,
  })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      displayData(data);
    })
    .catch(error => console.error('Error fetching data:', error));
}

// Display data in the dashboard container
function displayData(data) {
  const container = document.querySelector('.dashboard-container');
  if (!container) {
    console.error('Dashboard container not found!');
    return;
  }

  let html = '<h2>Data for Selected Date</h2>';

  // Service Requests
  html += '<h3>Service Requests</h3>';
  if (data.serviceRequests && data.serviceRequests.length > 0) {
    html += '<ul>';
    data.serviceRequests.forEach(request => {
      html += `<li>Request ID: ${request.request_id}, Status: ${request.status}</li>`;
    });
    html += '</ul>';
  } else {
    html += '<p>No service requests found.</p>';
  }

  // Contact Forums
  html += '<h3>Contact Forums</h3>';
  if (data.contactForums && data.contactForums.length > 0) {
    html += '<ul>';
    data.contactForums.forEach(forum => {
      html += `<li>Title: ${forum.title}, Content: ${forum.content}</li>`;
    });
    html += '</ul>';
  } else {
    html += '<p>No contact forums found.</p>';
  }

  // Events
  html += '<h3>Events</h3>';
  if (data.events && data.events.length > 0) {
    html += '<ul>';
    data.events.forEach(event => {
      html += `<li>Title: ${event.title}, Description: ${event.description}</li>`;
    });
    html += '</ul>';
  } else {
    html += '<p>No events found.</p>';
  }

  // News
  html += '<h3>News</h3>';
  if (data.news && data.news.length > 0) {
    html += '<ul>';
    data.news.forEach(news => {
      html += `<li>Title: ${news.title}, Content: ${news.content}</li>`;
    });
    html += '</ul>';
  } else {
    html += '<p>No news found.</p>';
  }

  container.innerHTML = html;
}
