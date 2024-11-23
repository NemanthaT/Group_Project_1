document.addEventListener('DOMContentLoaded', function() {
    const addAppointmentBtn = document.getElementById('addAppointmentBtn');
    const addAppointmentOverlay = document.getElementById('addAppointmentOverlay');
    const closeBtn = document.querySelector('.close-btn');
    const appointmentForm = document.getElementById('appointmentForm');
    const appointmentList = document.getElementById('appointmentList');

    function centerOverlay() {
        addAppointmentOverlay.style.display = 'flex';
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

    appointmentForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(appointmentForm);

        fetch('add_appointment.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                addAppointmentOverlay.style.display = 'none';
                appointmentForm.reset();
                loadAppointments();
            } else {
                alert('Error adding appointment: ' + result.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

const bookAppointmentBtn = document.getElementById('bookAppointmentBtn');

bookAppointmentBtn.addEventListener('click', function() {
    const formData = new FormData(appointmentForm);

    fetch('add_appointment.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            addAppointmentOverlay.style.display = 'none';
            appointmentForm.reset();
            loadAppointments();
        } else {
            alert('Error adding appointment: ' + result.message);
        }
    })
    .catch(error => console.error('Error:', error));
});