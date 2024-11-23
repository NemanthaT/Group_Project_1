// Function to search through case studies
function searchCaseStudies() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const caseStudies = document.querySelectorAll('.case-study-card');

    caseStudies.forEach(study => {
        const title = study.querySelector('h3').textContent.toLowerCase();
        const description = study.querySelector('p').textContent.toLowerCase();
        if (title.includes(input) || description.includes(input)) {
            study.style.display = 'flex';
        } else {
            study.style.display = 'none';
        }
    });
}

// Function to dynamically load case studies (assuming they are fetched from the server)
function loadCaseStudies() {
    // For now, let's simulate some static case study data
    const caseStudyData = [
        {
            title: 'Case Study 1',
            description: 'A detailed case study about project X.',
            tags: ['Tag1', 'Tag2'],
        },
        {
            title: 'Case Study 2',
            description: 'An in-depth analysis of project Y.',
            tags: ['Tag3', 'Tag4'],
        }
    ];

    const caseStudyList = document.getElementById('caseStudyList');
    caseStudyList.innerHTML = ''; // Clear existing list

    caseStudyData.forEach(study => {
        const card = document.createElement('div');
        card.classList.add('case-study-card');

        const title = document.createElement('h3');
        title.textContent = study.title;

        const description = document.createElement('p');
        description.textContent = study.description;

        const tags = document.createElement('div');
        tags.classList.add('tags');
        tags.textContent = study.tags.join(', ');

        card.appendChild(title);
        card.appendChild(description);
        card.appendChild(tags);

        caseStudyList.appendChild(card);
    });
}

// Load case studies on page load
window.onload = loadCaseStudies;
