function showUpdateForm() {
    document.getElementById('updateFormPopup').style.display = 'flex';
    // Clear password fields and messages when showing form
    document.getElementById('currentPassword').value = '';
    document.getElementById('newPassword').value = '';
    document.getElementById('confirmPassword').value = '';
    document.getElementById('passwordMessage').textContent = '';
    document.getElementById('passwordMessage').style.color = '';
}

function hideUpdateForm() {
    document.getElementById('updateFormPopup').style.display = 'none';
}

// Check if passwords match
function checkPasswordMatch() {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const messageElement = document.getElementById('passwordMessage');
    
    if (newPassword === '' && confirmPassword === '') {
        messageElement.textContent = '';
        return true;
    } else if (newPassword !== confirmPassword) {
        messageElement.textContent = 'Passwords do not match!';
        messageElement.style.color = 'red';
        return false;
    } else {
        messageElement.textContent = 'Passwords match.';
        messageElement.style.color = 'green';
        return true;
    }
}

// Add event listeners for password fields
document.getElementById('newPassword').addEventListener('input', checkPasswordMatch);
document.getElementById('confirmPassword').addEventListener('input', checkPasswordMatch);

document.getElementById('updateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Check if passwords match before submitting
    if (!checkPasswordMatch()) {
        return;
    }
    
    const formData = new FormData();
    formData.append('fullName', document.getElementById('fullName').value);
    formData.append('address', document.getElementById('address').value);
    formData.append('phone', document.getElementById('phone').value);
    
    // Add password fields if the current password is provided
    const currentPassword = document.getElementById('currentPassword').value;
    if (currentPassword) {
        formData.append('currentPassword', currentPassword);
        formData.append('newPassword', document.getElementById('newPassword').value);
    }

    fetch('update_profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            // Update displayed values
            document.getElementById('fullNameDisplay').textContent = document.getElementById('fullName').value;
            document.getElementById('addressDisplay').textContent = document.getElementById('address').value;
            document.getElementById('phoneDisplay').textContent = document.getElementById('phone').value;
            
            // Hide form and show success message
            hideUpdateForm();
            alert('Profile updated successfully!' + (data.passwordChanged ? ' Password was also updated.' : ''));
        } else {
            alert('Error updating profile: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error updating profile: ' + error);
    });
});
