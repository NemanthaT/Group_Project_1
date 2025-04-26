function openPopup(id) {
    console.log('Opening popup:', id);
    document.getElementById(id).style.display = 'flex';
}

function closePopup(id) {
    document.getElementById(id).style.display = 'none';
}

function formatDate(date) {
    if (!date) return '';  
    
    let formattedDate = new Date(date);
    if (isNaN(formattedDate)) return ''; // Handle invalid date format

    let year = formattedDate.getFullYear();
    let month = (formattedDate.getMonth() + 1).toString().padStart(2, '0'); 
    let day = formattedDate.getDate().toString().padStart(2, '0');

    return `${year}-${month}-${day}`;
}

// Add this new function to your existing script
function openViewPopup(){
    console.log('Opening View Popup');
    openPopup('viewAppointmentOverlay');
}



function openUpdatePopup(appointmentId, serviceSelect, appointmentDate, additionalMessage) {
    console.log('Opening Update Popup');
    console.log('Appointment ID:', appointmentId);
    console.log('Service:', serviceSelect);
    console.log('Date:', appointmentDate);
    console.log('Message:', additionalMessage);

    document.getElementById('editAppointmentid').value = appointmentId || ''; 
    document.getElementById('editServiceSelect').value = serviceSelect || ''; 
    document.getElementById('editAppointmentDate').value = formatDate(appointmentDate) || '';  
    document.getElementById('editAdditionalMessage').value = additionalMessage || ''; 

    openPopup('EditAppointmentOverlay'); 
}

function openViewPopup(appointmentId, serviceSelect, appointmentDate, additionalMessage) {
    console.log('Opening View Popup');
    console.log('Appointment ID:', appointmentId);
    console.log('Service:', serviceSelect);
    console.log('Date:', appointmentDate);
    console.log('Message:', additionalMessage);

    document.getElementById('viewAppointmentId').value = appointmentId || ''; 
    document.getElementById('viewAppointmentDate').value = formatDate(appointmentDate) || '';  

    openPopup('viewAppointmentOverlay'); 
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
