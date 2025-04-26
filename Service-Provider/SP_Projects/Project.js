document.addEventListener('DOMContentLoaded', function() {
    // Get filter elements
    const statusFilter = document.getElementById('status-filter');
    const searchInput = document.getElementById('search');
    const clearButton = document.getElementById('clear-filters');
    
    // Add event listeners
    if (statusFilter) {
        statusFilter.addEventListener('change', filterProjects);
    }
    
    if (searchInput) {
        // Filter as user types
        searchInput.addEventListener('input', filterProjects);
    }
    
    // Add clear button event listener
    if (clearButton) {
        clearButton.addEventListener('click', clearFilters);
    }
    addClearButtonStyles();
});

function addClearButtonStyles() {
    // Create a style element if it doesn't exist
    let style = document.getElementById('filter-styles');
    if (!style) {
        style = document.createElement('style');
        style.id = 'filter-styles';
        document.head.appendChild(style);
    }
}

/* Filter projects based on status and search term */
function filterProjects() {
    const statusFilter = document.getElementById('status-filter').value.toLowerCase();
    const searchTerm = document.getElementById('search').value.trim().toLowerCase();
    
    // Get all project cards
    const projectCards = document.querySelectorAll('.project-card');
    
    projectCards.forEach(card => {
        // Get project status from the card
        const statusElement = card.querySelector('.status');
        const projectStatus = statusElement ? statusElement.textContent.trim().toLowerCase() : '';
        
        // Get client name from the card
        const clientNameElement = card.querySelector('.project-info p:nth-child(4)'); // Assuming client name is in the 4th paragraph
        const clientName = clientNameElement ? clientNameElement.textContent.replace('Client Name:', '').trim().toLowerCase() : '';
        
        // Get project name/service from the card
        const serviceElement = card.querySelector('.project-info p:nth-child(1)'); // Assuming service is in the 1st paragraph
        const serviceName = serviceElement ? serviceElement.textContent.replace('Service:', '').trim().toLowerCase() : '';
        
        // Commented out project ID filtering
        /*
        // Get project ID from the card
        const projectIdElement = card.querySelector('.project-info p:nth-child(4)'); // Assuming project ID is in the 4th paragraph
        const projectId = projectIdElement ? projectIdElement.textContent.replace('Project ID:', '').trim().toLowerCase() : '';
        */
        
        // Determine if the card should be shown based on filters
        let showCard = true;
        
        // Filter by status (if not "all")
        if (statusFilter !== 'all' && projectStatus !== statusFilter) {
            showCard = false;
        }
        
        // Filter by search term (client name or service name)
        if (searchTerm && !clientName.includes(searchTerm) && !serviceName.includes(searchTerm)) {
            showCard = false;
        }
        
        // Show or hide the card
        card.style.display = showCard ? '' : 'none';
    });
    
    // Show "No projects found" message if all cards are hidden
    updateNoProjectsMessage();
}

/* Clear all filters and reset the view */
function clearFilters() {
    // Reset filter values
    document.getElementById('status-filter').value = 'all';
    document.getElementById('search').value = '';
    
    // Show all project cards
    const projectCards = document.querySelectorAll('.project-card');
    projectCards.forEach(card => {
        card.style.display = '';
    });
    
    // Remove any "no projects" message
    const projectsGrid = document.querySelector('.projects-grid');
    const existingMessage = projectsGrid.querySelector('.no-projects-message');
    if (existingMessage) {
        existingMessage.remove();
    }
}

/* Update "No projects found" message */
function updateNoProjectsMessage() {
    const projectsGrid = document.querySelector('.projects-grid');
    const projectCards = document.querySelectorAll('.project-card');
    const visibleCards = Array.from(projectCards).filter(card => card.style.display !== 'none');
    
    // Remove existing message
    const existingMessage = projectsGrid.querySelector('.no-projects-message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    // Add message if no cards are visible
    if (visibleCards.length === 0) {
        const noProjectsMessage = document.createElement('p');
        noProjectsMessage.className = 'no-projects-message';
        noProjectsMessage.textContent = 'No projects found.';
        projectsGrid.appendChild(noProjectsMessage);
    }
}

 /* Show or hide "No projects found" message based on visible cards */
function updateNoProjectsMessage() {
    const projectCards = document.querySelectorAll('.project-card');
    const projectsGrid = document.querySelector('.projects-grid');
    
    // Check if any cards are visible
    let visibleCards = 0;
    projectCards.forEach(card => {
        if (card.style.display !== 'none') {
            visibleCards++;
        }
    });
    
    // Remove existing "no projects" message if it exists
    const existingMessage = projectsGrid.querySelector('.no-projects-message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    // Add message if no visible cards
    if (visibleCards === 0) {
        const noProjectsMessage = document.createElement('p');
        noProjectsMessage.className = 'no-projects-message';
        noProjectsMessage.textContent = 'No projects found matching your filters.';
        projectsGrid.appendChild(noProjectsMessage);
    }
}