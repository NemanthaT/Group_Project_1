function showUpdateForm() {
    document.getElementById('updateFormPopup').style.display = 'flex';
    document.getElementById('currentPassword').value = '';
    document.getElementById('newPassword').value = '';
    document.getElementById('confirmPassword').value = '';
    document.getElementById('passwordMessage').textContent = '';
    document.getElementById('passwordMessage').style.color = '';
}

function hideUpdateForm() {
    document.getElementById('updateFormPopup').style.display = 'none';
}

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

document.getElementById('newPassword').addEventListener('input', checkPasswordMatch);
document.getElementById('confirmPassword').addEventListener('input', checkPasswordMatch);

document.getElementById('updateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!checkPasswordMatch()) {
        return;
    }
    
    const formData = new FormData();
    formData.append('fullName', document.getElementById('fullName').value);
    formData.append('address', document.getElementById('address').value);
    formData.append('phone', document.getElementById('phone').value);
    
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
            document.getElementById('fullNameDisplay').textContent = document.getElementById('fullName').value;
            document.getElementById('addressDisplay').textContent = document.getElementById('address').value;
            document.getElementById('phoneDisplay').textContent = document.getElementById('phone').value;
            
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
