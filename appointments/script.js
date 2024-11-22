document.addEventListener('DOMContentLoaded', function() {
    const addAppointmentBtn = document.getElementById('addAppointmentBtn');
    const addAppointmentOverlay = document.getElementById('addAppointmentOverlay');
    const closeBtn = document.querySelector('.close-btn');
    const appointmentForm = document.getElementById('appointmentForm');
    const appointmentList = document.getElementById('appointmentList');

    function centerOverlay() {
        addAppointmentOverlay.style.display = 'flex';
    }

    /*function loadAppointments() {
        fetch('load_appointments.php')
            .then(response => response.json())
            .then(appointments => {
                appointmentList.innerHTML = '';
                appointments.forEach(appointment => {
                    const row = `
                        <tr data-id="${appointment.appointment_id}">
                            <td>${appointment.appointment_id}</td>
                            <td>${appointment.service_type}</td>
                            <td>${appointment.appointment_date}</td>
                            <td>${appointment.status}</td>
                            <td>${appointment.created_at}</td>
                            <td>
                                <div class="action-icons">
                                    <i class="edit-icon">✏️</i>
                                    <i class="delete-icon">🗑️</i>
                                </div>
                            </td>
                        </tr>
                    `;
                    appointmentList.innerHTML += row;
                });
            })
            .catch(error => console.error('Error loading appointments:', error));
    }

    loadAppointments();*/

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