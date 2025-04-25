document.addEventListener("DOMContentLoaded", () => {
    const editButton = document.querySelector(".edit-button");
    const profileImage = document.querySelector("#profileImage");
    const profileImageContainer = document.querySelector(".profile-image");
    const profileImageInput = document.createElement("input");
    let isEditing = false;

    // File input for image upload
    profileImageInput.type = "file";
    profileImageInput.accept = "image/*";
    profileImageInput.style.display = "none";
    document.body.appendChild(profileImageInput);

    // Function to toggle edit mode
    function toggleEdit() {
        if (isEditing) {
            saveProfileChanges();
            editButton.textContent = "Edit";
            profileImageContainer.classList.remove("editing"); // Remove editing class
        } else {
            enterEditMode();
            editButton.textContent = "Save";
            profileImageContainer.classList.add("editing"); // Add editing class
        }
        isEditing = !isEditing;
    }

    // Enter edit mode
    function enterEditMode() {
        // Replace text with input fields
        document.querySelector("#name").outerHTML = `<input type="text" id="name" value="${document.querySelector("#name").textContent}">`;
        document.querySelector("#gender").outerHTML = `<input type="text" id="gender" value="${document.querySelector("#gender").textContent}">`;
        document.querySelector("#email").outerHTML = `<input type="email" id="email" value="${document.querySelector("#email").textContent}">`;
        document.querySelector("#phone").outerHTML = `<input type="tel" id="phone" value="${document.querySelector("#phone").textContent}">`;
        document.querySelector("#address").outerHTML = `<input type="text" id="address" value="${document.querySelector("#address").textContent}">`;
        document.querySelector("#introduction").outerHTML = `<textarea id="introduction">${document.querySelector("#introduction").textContent}</textarea>`;
        document.querySelector("#field").outerHTML = `<input type="text" id="field" value="${document.querySelector("#field").textContent}">`;
        document.querySelector("#speciality").outerHTML = `<input type="text" id="speciality" value="${document.querySelector("#speciality").textContent}">`;
        document.querySelector("#service_description").outerHTML = `<textarea id="service_description">${document.querySelector("#service_description").textContent}</textarea>`;
        document.querySelector("#certifications").outerHTML = `<textarea id="certifications">${document.querySelector("#certifications").textContent}</textarea>`;
        document.querySelector("#awards").outerHTML = `<textarea id="awards">${document.querySelector("#awards").textContent}</textarea>`;

        // Enable image upload
        profileImage.addEventListener("click", triggerImageUpload);
    }

    // Helper function to convert newlines to <br> tags
    function nl2br(str) {
        return str.replace(/\n/g, '<br>');
    }

    // Save changes and update database
    function saveProfileChanges() {
        const formData = new FormData();
        formData.append("full_name", document.querySelector("#name").value);
        formData.append("gender", document.querySelector("#gender").value);
        formData.append("email", document.querySelector("#email").value);
        formData.append("phone", document.querySelector("#phone").value);
        formData.append("address", document.querySelector("#address").value);
        formData.append("introduction", document.querySelector("#introduction").value);
        formData.append("field", document.querySelector("#field").value);
        formData.append("speciality", document.querySelector("#speciality").value);
        formData.append("service_description", document.querySelector("#service_description").value);
        formData.append("certifications", document.querySelector("#certifications").value);
        formData.append("awards", document.querySelector("#awards").value);
        
        if (profileImageInput.files[0]) {
            formData.append("profile_image", profileImageInput.files[0]);
        }

        // Send data to server with a more explicit path
        fetch("./Profile_handler.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status} - ${response.statusText}`);
            }
            return response.text();
        })
        .then(data => {
            if (data === "success") {
                // Update display
                const newImageSrc = profileImage.src;
                document.querySelector("#profileName").textContent = document.querySelector("#name").value;
                document.querySelector("#name").outerHTML = `<span id="name">${document.querySelector("#name").value}</span>`;
                document.querySelector("#gender").outerHTML = `<span id="gender">${document.querySelector("#gender").value}</span>`;
                document.querySelector("#email").outerHTML = `<span id="email">${document.querySelector("#email").value}</span>`;
                document.querySelector("#phone").outerHTML = `<span id="phone">${document.querySelector("#phone").value}</span>`;
                document.querySelector("#address").outerHTML = `<span id="address">${document.querySelector("#address").value}</span>`;
                document.querySelector("#introduction").outerHTML = `<span id="introduction">${nl2br(document.querySelector("#introduction").value)}</span>`;
                document.querySelector("#field").outerHTML = `<span id="field">${document.querySelector("#field").value}</span>`;
                document.querySelector("#speciality").outerHTML = `<span id="speciality">${document.querySelector("#speciality").value}</span>`;
                document.querySelector("#service_description").outerHTML = `<span id="service_description">${nl2br(document.querySelector("#service_description").value)}</span>`;
                document.querySelector("#certifications").outerHTML = `<span id="certifications">${nl2br(document.querySelector("#certifications").value)}</span>`;
                document.querySelector("#awards").outerHTML = `<span id="awards">${nl2br(document.querySelector("#awards").value)}</span>`;

                alert("Profile updated successfully!");
            } else {
                alert("Error updating profile: " + data);
            }
        })
        .catch(error => {
            console.error("Fetch Error:", error);
            alert("An error occurred while updating the profile: " + error.message);
        });

        // Remove image click event
        profileImage.removeEventListener("click", triggerImageUpload);
    }

    // Trigger file input click
    function triggerImageUpload() {
        profileImageInput.click();
    }

    // Handle image file selection
    profileImageInput.addEventListener("change", () => {
        const file = profileImageInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = () => {
                profileImage.src = reader.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Attach toggle function to edit button
    editButton.addEventListener("click", toggleEdit);
});