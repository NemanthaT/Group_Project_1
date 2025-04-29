document.addEventListener("DOMContentLoaded", () => {
    const editButton = document.querySelector(".edit-button");
    const saveButton = document.querySelector(".save-button");
    const profileImage = document.querySelector("#profileImage");
    const profileImageContainer = document.querySelector(".profile-image");
    const profileImageInput = document.querySelector("#profileImageInput");
    let isEditing = false;

    function toggleEdit() {
        if (isEditing) {
            revertToDisplayMode();
            editButton.textContent = "Edit";
            saveButton.style.display = "none"; 
            profileImageContainer.classList.remove("editing");
            profileImage.removeEventListener("click", triggerImageUpload);
        } else {
            enterEditMode();
            editButton.textContent = "Cancel";
            saveButton.style.display = "inline-block"; 
            profileImageContainer.classList.add("editing");
        }
        isEditing = !isEditing;
    }

    function enterEditMode() {
        document.querySelector("#name").outerHTML = `<input type="text" id="name" name="full_name" value="${document.querySelector("#name").textContent}" required>`;
        document.querySelector("#gender").outerHTML = `<input type="text" id="gender" name="gender" value="${document.querySelector("#gender").textContent}" required>`;
        document.querySelector("#email").outerHTML = `<input type="email" id="email" name="email" value="${document.querySelector("#email").textContent}" required>`;
        document.querySelector("#phone").outerHTML = `<input type="tel" pattern="[0-9]{10}" id="phone" name="phone" value="${document.querySelector("#phone").textContent}" required>`;
        document.querySelector("#address").outerHTML = `<input type="text" id="address" name="address" value="${document.querySelector("#address").textContent}" required>`;
        document.querySelector("#introduction").outerHTML = `<textarea id="introduction" name="introduction" required>${document.querySelector("#introduction").textContent}</textarea>`;
        document.querySelector("#field").outerHTML = `<input type="text" id="field" name="field" value="${document.querySelector("#field").textContent}" required>`;
        document.querySelector("#speciality").outerHTML = `<input type="text" id="speciality" name="speciality" value="${document.querySelector("#speciality").textContent}" required>`;
        document.querySelector("#service_description").outerHTML = `<textarea id="service_description" name="service_description" required>${document.querySelector("#service_description").textContent}</textarea>`;
        document.querySelector("#certifications").outerHTML = `<textarea id="certifications" name="certifications">${document.querySelector("#certifications").textContent}</textarea>`;
        document.querySelector("#awards").outerHTML = `<textarea id="awards" name="awards">${document.querySelector("#awards").textContent}</textarea>`;

        profileImage.addEventListener("click", triggerImageUpload);
    }

    function nl2br(str) {
        return str.replace(/\n/g, '<br>');
    }

    function revertToDisplayMode() {
        const profileName = document.querySelector("#profileName").textContent;
        document.querySelector("#name").outerHTML = `<span id="name">${profileName}</span>`;
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
    }

    function triggerImageUpload() {
        profileImageInput.click();
    }

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

    editButton.addEventListener("click", toggleEdit);
});