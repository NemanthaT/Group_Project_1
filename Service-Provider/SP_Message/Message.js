// Search Functionality
document.querySelector('.search-button').addEventListener('click', function () {
    const searchValue = document.querySelector('.message-controls input[placeholder="Client ID/Topic"]').value.trim().toLowerCase();

    const rows = document.querySelectorAll('#message-tbody tr');

    rows.forEach(row => {
        const clientIdCell = row.children[0].textContent.toLowerCase(); // Ckient ID
        const topicCell = row.children[1].textContent.toLowerCase(); // Topic

        // Show/hide row based on whether the search value matches Client ID or Topic
        if (clientIdCell.includes(searchValue) || topicCell.includes(searchValue)) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
});

// Open Create Chat Modal
document.querySelector('.create-chat-button').addEventListener('click', function () {
    document.getElementById('create-chat-modal').style.display = 'flex';
});

// Close Create Chat Modal
document.querySelector('.close-create-chat-modal').addEventListener('click', function () {
    document.getElementById('create-chat-modal').style.display = 'none';
});

// Close Create Chat Modal when clicking outside of it
window.addEventListener('click', function (event) {
    const modal = document.getElementById('create-chat-modal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

// Handle Create Chat Form Submission
document.getElementById('create-chat-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent page reload

    // Get input values
    const clientId = document.getElementById('client-id').value;
    const topic = document.getElementById('topic').value;
    const message = document.getElementById('message').value;

    // Log or send the values for further processing (e.g., AJAX to create a new chat)
    console.log('Client ID:', clientId);
    console.log('Topic:', topic);
    console.log('Message:', message);

    // Close the modal after submission
    document.getElementById('create-chat-modal').style.display = 'none';
});

// Add Chat Button to Each Row
function addRow(clientId, topic, message, status) {
    const tableBody = document.getElementById('message-tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${clientId}</td>
        <td>${topic}</td>
        <td>${message}</td>
        <td>${status}</td>
        <td><button class="chat-button" data-client-id="${clientId}">Chat</button></td>
    `;
    tableBody.appendChild(newRow);

    // Add Event Listener to Chat Button
    newRow.querySelector('.chat-button').addEventListener('click', openChatModal);
}

// Open Chat Modal
function openChatModal(event) {
    const chatModal = document.getElementById('chat-modal');
    chatModal.style.display = 'flex';

    // Get Client ID from Button
    const clientId = event.target.getAttribute('data-client-id');
    document.getElementById('chat-window').innerHTML = `<p>Chatting with Client ID: ${clientId}</p>`;
}

// Close Chat Modal
document.querySelector('.close-chat-modal').addEventListener('click', function () {
    document.getElementById('chat-modal').style.display = 'none';
});

// Send Chat Message
document.getElementById('send-chat').addEventListener('click', function () {
    const chatInput = document.getElementById('chat-input');
    const chatMessage = chatInput.value.trim();

    if (chatMessage) {
        const chatWindow = document.getElementById('chat-window');
        const newMessage = document.createElement('p');
        newMessage.textContent = `You: ${chatMessage}`;
        chatWindow.appendChild(newMessage);
        chatInput.value = '';
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }
});

// Close Modal on Outside Click
window.addEventListener('click', function (event) {
    const chatModal = document.getElementById('chat-modal');
    if (event.target === chatModal) {
        chatModal.style.display = 'none';
    }
});

// Example: Add Rows Dynamically
addRow('20', 'Market Analysis', 'Request for financial market trends analysis', 'Seen');
addRow('25', 'Investment Strategy', 'Need a consultation on investment portfolio diversification', 'Replied');
addRow('30', 'Budget Planning', 'Assistance required for annual budget planning', 'Unseen');
addRow('35', 'Risk Assessment', 'Evaluation of financial risks in new projects', 'Seen');
addRow('40', 'Tax Consultancy', 'Guidance on tax-saving strategies for Q4', 'Unseen');
addRow('45', 'M&A Research', 'Insights on potential mergers and acquisitions', 'Replied');
addRow('50', 'Financial Training', 'Request for training on financial modeling techniques', 'Seen');
addRow('55', 'Accounting Standards', 'Clarification on compliance with new IFRS standards', 'Replied');
addRow('60', 'Startup Funding', 'Help with preparing a pitch for seed funding', 'Unseen');
addRow('65', 'Corporate Training', 'Training session on advanced financial analysis', 'Seen');
addRow('70', 'Economic Trends', 'Detailed report on global economic trends affecting investments', 'Replied');
addRow('75', 'Debt Management', 'Consultation for restructuring corporate debt', 'Seen');

