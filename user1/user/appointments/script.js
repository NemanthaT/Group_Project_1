function openPopup(id) {
    document.getElementById(id).style.display = 'flex';
}

function closePopup(id) {
    document.getElementById(id).style.display = 'none';
}

function formatDate(date) {
    if (!date) return '';  // Handle empty values

    let formattedDate = new Date(date);
    let year = formattedDate.getFullYear();
    let month = (formattedDate.getMonth() + 1).toString().padStart(2, '0'); // Month is 0-based, so we add 1
    let day = formattedDate.getDate().toString().padStart(2, '0');

    return `${year}-${month}-${day}`;  // Return in the format YYYY-MM-DD
}

function openUpdatePopup(appointmentId, serviceSelect, appointmentDate, additionalMessage) {

    console.log('Appointment ID:', appointmentId);
    console.log('Service:', serviceSelect);
    console.log('Date:', appointmentDate);
    console.log('Message:', additionalMessage);

    document.getElementById('editAppointmentid').value = appointmentId || ''; // Fallback to empty string
    document.getElementById('editServiceSelect').value = serviceSelect || ''; // Ensure value is set
    document.getElementById('editAppointmentDate').value = formatDate(appointmentDate) || '';  // Date field (ensure the format is correct)
    document.getElementById('editAdditionalMessage').value = additionalMessage || ''; // Ensure message is set

    openPopup('EditAppointmentOverlay'); // Correct ID for the popup
}

// modal.js
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('popupModal');
    if (modal) {
        modal.style.display = 'block';
    }

    const closeModal = () => {
        if (modal) {
            modal.style.opacity = '0';  // Apply fade-out effect
            setTimeout(() => {
                modal.style.display = 'none';  // Hide modal after fade-out transition
            }, 300);  // Match transition duration (300ms)
        }
    };

    // Attach close functionality to buttons and close icon
    const closeButtons = document.querySelectorAll('.close-modal, .btn');
    closeButtons.forEach((button) => {
        button.addEventListener('click', closeModal);
    });
});
