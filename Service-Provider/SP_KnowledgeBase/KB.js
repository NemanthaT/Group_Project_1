// Function to search through case studies
function searchCaseStudies() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const caseStudies = document.querySelectorAll('.case-study-card');

    caseStudies.forEach(study => {
        const title = study.querySelector('h4').textContent.toLowerCase(); // Updated to select 'h4' as the title element
        if (title.includes(input)) {
            study.style.display = 'flex'; // Show if input matches the title
        } else {
            study.style.display = 'none'; // Hide otherwise
        }
    });
}

function clearSearch() {
    const input = document.getElementById('searchInput');
    const caseStudies = document.querySelectorAll('.case-study-card');
    input.value = ''; // Clear the search input
    caseStudies.forEach(study => {
        study.style.display = 'flex'; // Show all case studies
    });
}

// Confirm delete before submitting
function confirmDelete(paperId) {
    if (confirm("Are you sure you want to delete this case study?")) {
        return true;
    }
    return false;
}

// Toggle between read-only and editable mode
function toggleEdit() {
    var titleField = document.getElementById("title");
    var descriptionField = document.getElementById("description");
    var editButton = document.querySelector('button[onclick="toggleEdit()"]');

    // Check if fields exist
    if (!titleField || !descriptionField || !editButton) {
        console.error("Form fields or edit button not found.");
        return;
    }

    if (titleField.readOnly) {
        // Enable editing
        titleField.readOnly = false;
        descriptionField.readOnly = false;
        editButton.textContent = "Cancel Edit";
        // Ensure fields are not disabled
        titleField.disabled = false;
        descriptionField.disabled = false;
    } else {
        // Revert to read-only
        titleField.readOnly = true;
        descriptionField.readOnly = true;
        editButton.textContent = "Edit";
        // Reset field values to original if needed (optional, depends on your needs)
        // titleField.value = titleField.defaultValue;
        // descriptionField.value = descriptionField.defaultValue;
    }
}