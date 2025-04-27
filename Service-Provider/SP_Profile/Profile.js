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
            profileImageContainer.classList.remove("editing");
        } else {
            enterEditMode();
            editButton.textContent = "Save";
            profileImageContainer.classList.add("editing");
        }
        isEditing = !isEditing;
    }

    // Enter edit mode
    function enterEditMode() {
        // Replace text with input fields and add required attribute where necessary
        document.querySelector("#name").outerHTML = `<input type="text" id="name" name="full_name" value="${document.querySelector("#name").textContent}" required>`;
        document.querySelector("#gender").outerHTML = `<input type="text" id="gender" name="gender" value="${document.querySelector("#gender").textContent}" required>`;
        document.querySelector("#email").outerHTML = `<input type="email" id="email" name="email" value="${document.querySelector("#email").textContent}" required>`;
        document.querySelector("#phone").outerHTML = `<input type="tel" id="phone" name="phone" value="${document.querySelector("#phone").textContent}" required>`;
        document.querySelector("#address").outerHTML = `<input type="text" id="address" name="address" value="${document.querySelector("#address").textContent}" required>`;
        document.querySelector("#introduction").outerHTML = `<textarea id="introduction" name="introduction" required>${document.querySelector("#introduction").textContent}</textarea>`;
        document.querySelector("#field").outerHTML = `<input type="text" id="field" name="field" value="${document.querySelector("#field").textContent}" required>`;
        document.querySelector("#speciality").outerHTML = `<input type="text" id="speciality" name="speciality" value="${document.querySelector("#speciality").textContent}" required>`;
        document.querySelector("#service_description").outerHTML = `<textarea id="service_description" name="service_description" required>${document.querySelector("#service_description").textContent}</textarea>`;
        document.querySelector("#certifications").outerHTML = `<textarea id="certifications" name="certifications">${document.querySelector("#certifications").textContent}</textarea>`;
        document.querySelector("#awards").outerHTML = `<textarea id="awards" name="awards">${document.querySelector("#awards").textContent}</textarea>`;

        // Enable image upload
        profileImage.addEventListener("click", triggerImageUpload);
    }

    // Helper function to convert newlines to <br> tags
    function nl2br(str) {
        return str.replace(/\n/g, '<br>');
    }

    // Save changes and submit form
    function saveProfileChanges() {
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "";
        form.enctype = "multipart/form-data";

        // Add form inputs
        const fields = [
            "full_name", "gender", "email", "phone", "address",
            "introduction", "field", "speciality", "service_description",
            "certifications", "awards"
        ];

        fields.forEach(field => {
            const input = document.createElement("input");
            input.type = "hidden";
            input.name = field;
            input.value = document.querySelector(`[name="${field}"]`).value;
            form.appendChild(input);
        });

        // Add profile image if selected
        if (profileImageInput.files[0]) {
            const fileInput = document.createElement("input");
            fileInput.type = "file";
            fileInput.name = "profile_image";
            fileInput.files = profileImageInput.files;
            form.appendChild(fileInput);
        }

        // Submit the form
        document.body.appendChild(form);
        form.submit();

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