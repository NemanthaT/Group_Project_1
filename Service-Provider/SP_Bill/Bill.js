document.addEventListener('DOMContentLoaded', function() {
    // Get filter elements
    const statusFilter = document.getElementById('status-filter');
    const searchInput = document.getElementById('search');
    const searchButton = document.getElementById('search-btn');
    const clearButton = document.getElementById('clear-filters');
    
    // Add event listeners
    if (statusFilter) {
        statusFilter.addEventListener('change', filterBills);
    }
    
    if (searchButton) {
        searchButton.addEventListener('click', filterBills);
    }
    
    if (searchInput) {
        // Filter on Enter key press
        searchInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                filterBills();
            }
        });
    }
    
    // Add clear button event listener
    if (clearButton) {
        clearButton.addEventListener('click', clearFilters);
    }
    
    // Add CSS for the clear button if not already in the CSS file
    addClearButtonStyles();
    
    // Initialize calendar functionality
    initializeCalendar();
});

/**
 * Add CSS styles for the clear button
 */
function addClearButtonStyles() {
    // Create a style element if it doesn't exist
    let style = document.getElementById('filter-styles');
    if (!style) {
        style = document.createElement('style');
        style.id = 'filter-styles';
        document.head.appendChild(style);
    }
}

/* Filter bills based on status and project name or service */
function filterBills() {
    const statusFilter = document.getElementById('status-filter').value.toLowerCase();
    const searchTerm = document.getElementById('search').value.trim().toLowerCase();
    
    // Get all bill cards
    const billCards = document.querySelectorAll('.bill-card');
    
    billCards.forEach(card => {
        // Get bill status from the card
        const statusElement = card.querySelector('.status');
        const billStatus = statusElement ? statusElement.textContent.trim().toLowerCase() : '';
        
        // Get project name from the bill-header
        const projectNameElement = card.querySelector('.bill-header p'); // Project name is in the <p> tag
        const projectName = projectNameElement ? projectNameElement.textContent.replace('Project Name:', '').trim().toLowerCase() : '';
        
        // Get service/description from the card
        const serviceElement = card.querySelector('.bill-info p:nth-child(1)'); // Service is in the 1st paragraph
        const serviceName = serviceElement ? serviceElement.textContent.replace('Service:', '').trim().toLowerCase() : '';
        
        // Determine if the card should be shown based on filters
        let showCard = true;
        
        // Filter by status (if not "all")
        if (statusFilter !== 'all' && billStatus !== statusFilter) {
            showCard = false;
        }
        
        // Filter by project name or service name
        if (searchTerm && !projectName.includes(searchTerm) && !serviceName.includes(searchTerm)) {
            showCard = false;
        }
        
        // Show or hide the card
        card.style.display = showCard ? '' : 'none';
    });
    
    // Show "No bills found" message if all cards are hidden
    updateNoBillsMessage();
}

/* Show or hide "No bills found" message based on visible cards */
function updateNoBillsMessage() {
    const billCards = document.querySelectorAll('.bill-card');
    const billsGrids = document.querySelectorAll('.bills-grid');
    
    // Check if any cards are visible
    let visibleCards = 0;
    billCards.forEach(card => {
        if (card.style.display !== 'none') {
            visibleCards++;
        }
    });
    
    // Remove existing "no bills" messages
    const existingMessages = document.querySelectorAll('.no-bills-message');
    existingMessages.forEach(message => message.remove());
    
    // Add message if no visible cards
    if (visibleCards === 0 && billsGrids.length > 0) {
        const noBillsMessage = document.createElement('p');
        noBillsMessage.className = 'no-bills-message';
        noBillsMessage.textContent = 'No bills found matching your filters.';
        billsGrids[0].appendChild(noBillsMessage);
    }
}

/* Clear all filters and reset the view */
function clearFilters() {
    // Reset filter values
    document.getElementById('status-filter').value = 'all';
    document.getElementById('search').value = '';
    
    // Show all bill cards
    const billCards = document.querySelectorAll('.bill-card');
    billCards.forEach(card => {
        card.style.display = '';
    });
    
    // Remove any "no bills" message
    const existingMessages = document.querySelectorAll('.no-bills-message');
    existingMessages.forEach(message => message.remove());
}