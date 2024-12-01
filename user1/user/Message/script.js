// Search Functionality
document.querySelector('.search-button').addEventListener('click', function () {
    const searchValue = document.querySelector('.message-controls input[placeholder="Provider ID/Topic"]').value.trim().toLowerCase();

    const rows = document.querySelectorAll('#message-tbody tr');

    rows.forEach(row => {
        const providerIdCell = row.children[0].textContent.toLowerCase(); // Provider ID
        const topicCell = row.children[1].textContent.toLowerCase(); // Topic

        // Show/hide row based on whether the search value matches Provider ID or Topic
        if (providerIdCell.includes(searchValue) || topicCell.includes(searchValue)) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
});


// Add Chat Button to Each Row
function addRow(providerId, topic, message, status) {
    const tableBody = document.getElementById('message-tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>${providerId}</td>
        <td>${topic}</td>
        <td>${message}</td>
        <td>${status}</td>
        <td><button class="chat-button" data-provider-id="${providerId}">Chat</button></td>
    `;
    tableBody.appendChild(newRow);

    // Add Event Listener to Chat Button
    newRow.querySelector('.chat-button').addEventListener('click', openChatModal);
}

// Open Chat Modal
function openChatModal(event) {
    const chatModal = document.getElementById('chat-modal');
    chatModal.style.display = 'flex';

    // Get Provider ID from Button
    const providerId = event.target.getAttribute('data-provider-id');
    document.getElementById('chat-window').innerHTML = `<p>Chatting with Provider ID: ${providerId}</p>`;
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
addRow('101', 'Integration Issue', 'Error integrating with Teams', 'Seen');
addRow('102', 'Login Issue', 'Unable to log in', 'Replied');
addRow('103', 'Password Reset', 'Request for resetting the password', 'Unseen');
