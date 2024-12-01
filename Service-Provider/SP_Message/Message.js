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
addRow('1', 'Integration Issue', 'Error integrating with Teams', 'Seen');
addRow('10', 'Login Issue', 'Unable to log in', 'Replied');
addRow('15', 'Password Reset', 'Request for resetting the password', 'Unseen');
