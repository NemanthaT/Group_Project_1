function openPopup(id) {
    document.getElementById(id).style.display = 'flex';
}

function closePopup(id) {
    document.getElementById(id).style.display = 'none';
}

function openUpdatePopup(serviceSelect, appointmentDate, additionalMessage) {
    document.getElementById('serviceSelect').value = serviceSelect;
    document.getElementById('appointmentDate').value = appointmentDate;
    document.getElementById('additionalMessage').value = additionalMessage;
    openPopup('updatePopup');
}
// modal.js
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('popupModal');
    if (modal) {
        modal.style.display = 'block';
    }

    const closeModal = () => {
        if (modal) {
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300); // Match transition duration
        }
    };

    // Attach close functionality to buttons and close icon
    const closeButtons = document.querySelectorAll('.close-modal, .btn');
    closeButtons.forEach((button) => {
        button.addEventListener('click', closeModal);
    });
});
