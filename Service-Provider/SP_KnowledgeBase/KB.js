function searchCaseStudies() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const caseStudies = document.querySelectorAll('.case-study-card');

    caseStudies.forEach(study => {
        const title = study.querySelector('h4').textContent.toLowerCase(); 
        if (title.includes(input)) {
            study.style.display = 'flex'; 
        } else {
            study.style.display = 'none'; 
        }
    });
}

function clearSearch() {
    const input = document.getElementById('searchInput');
    const caseStudies = document.querySelectorAll('.case-study-card');
    input.value = ''; 
    caseStudies.forEach(study => {
        study.style.display = 'flex'; 
    });
}

function confirmDelete(paperId) {
    if (confirm("Are you sure you want to delete this case study?")) {
        return true;
    }
    return false;
}

function toggleEdit() {
    var titleField = document.getElementById("title");
    var descriptionField = document.getElementById("description");
    var editButton = document.querySelector('button[onclick="toggleEdit()"]');

    if (!titleField || !descriptionField || !editButton) {
        console.error("Form fields or edit button not found.");
        return;
    }

    if (titleField.readOnly) {
        titleField.readOnly = false;
        descriptionField.readOnly = false;
        editButton.textContent = "Cancel Edit";
        titleField.disabled = false;
        descriptionField.disabled = false;
    } else {
        titleField.readOnly = true;
        descriptionField.readOnly = true;
        editButton.textContent = "Edit";
    }
}