document.addEventListener('DOMContentLoaded', function() {
    const addAppointmentBtn = document.getElementById('addAppointmentBtn');
    const addAppointmentOverlay = document.getElementById('addAppointmentOverlay');
    const closeBtn = document.querySelector('.close-btn');
    const appointmentForm = document.getElementById('appointmentForm');
    const appointmentList = document.getElementById('appointmentList');
    const bookAppointmentBtn = document.getElementById('Bookappointmentbtn');

    function centerOverlay() {
        addAppointmentOverlay.style.display = 'flex';
    }

    function loadAppointments() {
        fetch('get_appointments.php')
            .then(response => response.text())
            .then(html => {
                appointmentList.innerHTML = html;
            })
            .catch(error => console.error('Error loading appointments:', error));
    }

    addAppointmentBtn.addEventListener('click', centerOverlay);
    
    closeBtn.addEventListener('click', () => {
        addAppointmentOverlay.style.display = 'none';
    });

    addAppointmentOverlay.addEventListener('click', function(event) {
        if (event.target === addAppointmentOverlay) {
            addAppointmentOverlay.style.display = 'none';
        }
    });

    // Handle form submission
    appointmentForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(appointmentForm);
        
        // Send the form data to add_appointment.php
        fetch('add_appointment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(result => {
            // Close the overlay
            addAppointmentOverlay.style.display = 'none';
            
            // Reset the form
            appointmentForm.reset();
            
            // Reload the appointments table
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error adding appointment. Please try again.');
        });
    });

    // Add click event listener for the Book Appointment button
    bookAppointmentBtn.addEventListener('click', function(event) {
        event.preventDefault();
        
        // Get form data
        const serviceSelect = document.getElementById('serviceSelect').value;
        const appointmentDate = document.getElementById('appointmentDate').value;
        const additionalMessage = document.getElementById('additionalMessage').value;
        
        // Validate form data
        if (!serviceSelect || !appointmentDate) {
            alert('Please fill in all required fields');
            return;
        }
        
        // Create FormData object
        const formData = new FormData();
        formData.append('serviceSelect', serviceSelect);
        formData.append('appointmentDate', appointmentDate);
        formData.append('additionalMessage', additionalMessage);
        
        // Send the data to add_appointment.php
        fetch('add_appointment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(result => {
            // Close the overlay
            addAppointmentOverlay.style.display = 'none';
            
            // Reset the form
            appointmentForm.reset();
            
            // Reload the page to show updated appointments
            window.location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error adding appointment. Please try again.');
        });
    });
    
});