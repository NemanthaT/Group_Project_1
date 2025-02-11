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
    
// Confirm delete before submitting
function confirmDelete(paperId) {
    if (confirm("Are you sure you want to delete this case study?")) {
        return true;
    }
    return false;
}

// Toggle between read-only and editable mode
function toggleEdit() {
    var titleField = document.getElementById("modalTitle");
    var descriptionField = document.getElementById("modalDescription");

    if (titleField.readOnly) {
        titleField.readOnly = false;
        descriptionField.readOnly = false;
    } else {
        titleField.readOnly = true;
        descriptionField.readOnly = true;
    }
}

// Close the modal
function closeModal() {
    document.getElementById("modalForm").style.display = "none";
    document.getElementById("modalOverlay").style.display = "none";
}
