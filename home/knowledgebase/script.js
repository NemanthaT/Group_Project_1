// script.js

// Select the Menu Toggle Button
const mobileMenu = document.getElementById('mobile_menu');

// Select the Navigation Links Container
const headerItem = document.querySelector('.header_item');

// Add Click Event Listener to the Menu Toggle Button
mobileMenu.addEventListener('click', () => {
    // Toggle the 'active' Class on the Navigation Links Container
    headerItem.classList.toggle('active');
});
