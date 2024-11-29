document.addEventListener("DOMContentLoaded", () => {
    const editButton = document.querySelector(".edit-button");
    const profileInfo = document.querySelector(".profile-info");
    const profileImage = document.querySelector(".profile-image img");
    const profileImageInput = document.createElement("input");
    let isEditing = false;

    // Initial profile details
    const profileDetails = {
        name: "Name",
        gender: "Male/Female",
        address: "Address",
        email: "Email Address",
        contact: "Contact Number",
        image: profileImage.src,
    };

    // Add file input for image selection (hidden initially)
    profileImageInput.type = "file";
    profileImageInput.accept = "image/*";
    profileImageInput.style.display = "none";

    // Function to toggle editing mode
    function toggleEdit() {
        if (isEditing) {
            saveProfileChanges();
            editButton.textContent = "Edit";
        } else {
            enterEditMode();
            editButton.textContent = "Save";
        }
        isEditing = !isEditing;
    }

    // Enter edit mode, replace text with input fields
    function enterEditMode() {
        profileInfo.innerHTML = `
            <li><strong>Name:</strong> <input type="text" id="name" value="${profileDetails.name}"></li>
            <li><strong>Gender:</strong> <input type="text" id="gender" value="${profileDetails.gender}"></li>
            <li><strong>Address:</strong> <input type="text" id="address" value="${profileDetails.address}"></li>
            <li><strong>Email:</strong> <input type="email" id="email" value="${profileDetails.email}"></li>
            <li><strong>Contact Number:</strong> <input type="tel" id="contact" value="${profileDetails.contact}"></li>
        `;

        // Add click handler for changing the profile image
        profileImage.addEventListener("click", triggerImageUpload);
    }

    // Save changes and exit edit mode
    function saveProfileChanges() {
        profileDetails.name = document.getElementById("name").value;
        profileDetails.gender = document.getElementById("gender").value;
        profileDetails.address = document.getElementById("address").value;
        profileDetails.email = document.getElementById("email").value;
        profileDetails.contact = document.getElementById("contact").value;

        profileInfo.innerHTML = `
            <li><strong>Name:</strong> ${profileDetails.name}</li>
            <li><strong>Gender:</strong> ${profileDetails.gender}</li>
            <li><strong>Address:</strong> ${profileDetails.address}</li>
            <li><strong>Email:</strong> ${profileDetails.email}</li>
            <li><strong>Contact Number:</strong> ${profileDetails.contact}</li>
        `;

        // Remove image click event after saving
        profileImage.removeEventListener("click", triggerImageUpload);
    }

    // Trigger file input click
    function triggerImageUpload() {
        profileImageInput.click();
    }

    // Handle image file selection and update the profile image
    profileImageInput.addEventListener("change", () => {
        const file = profileImageInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = () => {
                profileImage.src = reader.result;
                profileDetails.image = reader.result; // Save the new image source
            };
            reader.readAsDataURL(file);
        }
    });

    // Attach toggle function to edit button
    editButton.addEventListener("click", toggleEdit);

    // Append the hidden file input to the document
    document.body.appendChild(profileImageInput);
});
