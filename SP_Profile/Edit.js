document.addEventListener("DOMContentLoaded", () => {
    const editButton = document.querySelector(".edit-button");
    const profileInfo = document.querySelector(".profile-info");
    let isEditing = false;

    // Profile details for each item
    const profileDetails = {
        name: "John Doe",
        gender: "Male",
        address: "123 Main Street",
        email: "john.doe@example.com",
        contact: "+123456789"
    };

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
    }

    // Attach toggle function to edit button
    editButton.addEventListener("click", toggleEdit);
});
