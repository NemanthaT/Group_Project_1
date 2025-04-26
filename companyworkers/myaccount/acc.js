function showUpdateForm() {
    document.getElementById('updateFormPopup').style.display = 'flex';
}

function hideUpdateForm() {
    document.getElementById('updateFormPopup').style.display = 'none';
}

document.getElementById('updateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData();
    formData.append('fullName', document.getElementById('fullName').value);
    formData.append('address', document.getElementById('address').value);
    formData.append('phone', document.getElementById('phone').value);

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
            alert('Profile updated successfully!');
        } else {
            alert('Error updating profile: ' + data.message);
        }
    })
    .catch(error => {
        alert('Error updating profile: ' + error);
    });
});
