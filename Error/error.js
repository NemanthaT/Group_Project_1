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