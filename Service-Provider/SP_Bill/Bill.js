document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('status-filter');
    const searchInput = document.getElementById('search');
    const searchButton = document.getElementById('search-btn');
    const clearButton = document.getElementById('clear-filters');
 
    if (statusFilter) {
        statusFilter.addEventListener('change', filterBills);
    }
    
    if (searchButton) {
        searchButton.addEventListener('click', filterBills);
    }
    
    if (searchInput) {
        searchInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                filterBills();
            }
        });
    }
    
    if (clearButton) {
        clearButton.addEventListener('click', clearFilters);
    }
    
    addClearButtonStyles();
    
    initializeCalendar();
});

function addClearButtonStyles() {
    let style = document.getElementById('filter-styles');
    if (!style) {
        style = document.createElement('style');
        style.id = 'filter-styles';
        document.head.appendChild(style);
    }
}

function filterBills() {
    const statusFilter = document.getElementById('status-filter').value.toLowerCase();
    const searchTerm = document.getElementById('search').value.trim().toLowerCase();
    const billCards = document.querySelectorAll('.bill-card');
    
    billCards.forEach(card => {
        const statusElement = card.querySelector('.status');
        const billStatus = statusElement ? statusElement.textContent.trim().toLowerCase() : '';
        
        const projectNameElement = card.querySelector('.bill-header p'); 
        const projectName = projectNameElement ? projectNameElement.textContent.replace('Project Name:', '').trim().toLowerCase() : '';
        
        const serviceElement = card.querySelector('.bill-info p:nth-child(1)'); 
        const serviceName = serviceElement ? serviceElement.textContent.replace('Service:', '').trim().toLowerCase() : '';
        
        let showCard = true;
        
        if (statusFilter !== 'all' && billStatus !== statusFilter) {
            showCard = false;
        }
        
        if (searchTerm && !projectName.includes(searchTerm) && !serviceName.includes(searchTerm)) {
            showCard = false;
        }
        
        card.style.display = showCard ? '' : 'none';
    });
    
    updateNoBillsMessage();
}

function updateNoBillsMessage() {
    const billCards = document.querySelectorAll('.bill-card');
    const billsGrids = document.querySelectorAll('.bills-grid');
    
    let visibleCards = 0;
    billCards.forEach(card => {
        if (card.style.display !== 'none') {
            visibleCards++;
        }
    });
    
    const existingMessages = document.querySelectorAll('.no-bills-message');
    existingMessages.forEach(message => message.remove());
    
    if (visibleCards === 0 && billsGrids.length > 0) {
        const noBillsMessage = document.createElement('p');
        noBillsMessage.className = 'no-bills-message';
        noBillsMessage.textContent = 'No bills found matching your filters.';
        billsGrids[0].appendChild(noBillsMessage);
    }
}

function clearFilters() {
    document.getElementById('status-filter').value = 'all';
    document.getElementById('search').value = '';
    
    const billCards = document.querySelectorAll('.bill-card');
    billCards.forEach(card => {
        card.style.display = '';
    });
    
    const existingMessages = document.querySelectorAll('.no-bills-message');
    existingMessages.forEach(message => message.remove());
}