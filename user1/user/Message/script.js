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
    const clientId = document.getElementById('provider-id').value;
    const topic = document.getElementById('topic').value;
    const message = document.getElementById('message').value;

    // Log or send the values for further processing (e.g., AJAX to create a new chat)
    console.log('Provider ID:', providerId);
    console.log('Topic:', topic);
    console.log('Message:', message);

    // Close the modal after submission
    document.getElementById('create-chat-modal').style.display = 'none';
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
