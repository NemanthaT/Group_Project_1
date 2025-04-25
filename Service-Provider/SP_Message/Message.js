// Search Functionality
document.querySelector('.search-button').addEventListener('click', function () {
    const searchValue = document.querySelector('#search-input').value.trim().toLowerCase();
    const rows = document.querySelectorAll('#message-tbody tr');

    rows.forEach(row => {
        const clientName = row.children[0].textContent.toLowerCase();
        const topic = row.children[1].textContent.toLowerCase();
        row.style.display = (clientName.includes(searchValue) || topic.includes(searchValue)) ? '' : 'none';
    });
});

// Clear Filter Functionality
document.querySelector('.clear-button').addEventListener('click', function () {
    document.querySelector('#search-input').value = '';
    const rows = document.querySelectorAll('#message-tbody tr');
    rows.forEach(row => {
        row.style.display = '';
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

// Close Create Chat Modal on Outside Click
window.addEventListener('click', function (event) {
    const modal = document.getElementById('create-chat-modal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

// Handle Create Chat Form Submission
document.getElementById('create-chat-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const clientId = document.getElementById('client-id').value;
    const topic = document.getElementById('topic').value;
    const message = document.getElementById('message').value;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'Message_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
            if (xhr.responseText === 'Chat created successfully') {
                fetchThreads();
                document.getElementById('create-chat-form').reset();
                document.getElementById('create-chat-modal').style.display = 'none';
            }
        }
    };
    const data = `action=create_chat&client_id=${encodeURIComponent(clientId)}&topic=${encodeURIComponent(topic)}&message=${encodeURIComponent(message)}`;
    xhr.send(data);
});

// Open Chat Panel
let currentThreadId = null;
let pollingInterval = null;
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('chat-button')) {
        currentThreadId = event.target.getAttribute('data-thread-id');
        const clientName = event.target.getAttribute('data-client-name');
        document.getElementById('chat-client-name').textContent = clientName;
        document.getElementById('chat-panel').style.display = 'flex';
        document.getElementById('chat-window').innerHTML = '';

        // Fetch initial messages
        fetchMessages(currentThreadId);

        // Start polling for new messages
        pollingInterval = setInterval(() => fetchMessages(currentThreadId), 3000);
    }
});

// Close Chat Panel
document.querySelector('.close-chat-panel').addEventListener('click', function () {
    document.getElementById('chat-panel').style.display = 'none';
    clearInterval(pollingInterval);
    currentThreadId = null;
});

// Send Chat Message
document.getElementById('send-chat').addEventListener('click', function () {
    const message = document.getElementById('chat-input').value.trim();
    if (!message || !currentThreadId) return;

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'Message_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            if (xhr.responseText === 'Message sent') {
                document.getElementById('chat-input').value = '';
                fetchMessages(currentThreadId);
                fetchThreads();
            } else {
                alert(xhr.responseText);
            }
        }
    };
    const data = `action=send_message&thread_id=${currentThreadId}&message=${encodeURIComponent(message)}`;
    xhr.send(data);
});

// Fetch Messages
function fetchMessages(threadId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'Message_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('chat-window').innerHTML = xhr.responseText;
            const chatWindow = document.getElementById('chat-window');
            chatWindow.scrollTop = chatWindow.scrollHeight;
        }
    };
    xhr.send(`action=fetch_messages&thread_id=${threadId}`);
}

// Fetch Threads Dynamically
function fetchThreads() {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'Message_handler.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('message-tbody').innerHTML = xhr.responseText;
        }
    };
    xhr.send('action=fetch_threads');
}

// Start polling for thread updates
setInterval(fetchThreads, 5000);

// Initial thread fetch
document.addEventListener('DOMContentLoaded', function () {
    fetchThreads();

    // Check for client_id in URL and open chat panel if present
    const urlParams = new URLSearchParams(window.location.search);
    const clientId = urlParams.get('client_id');
    if (clientId) {
        // Wait for threads to load before attempting to find the chat button
        setTimeout(() => {
            const chatButton = document.querySelector(`.chat-button[data-client-id="${clientId}"]`);
            if (chatButton) {
                chatButton.click(); // Trigger click to open chat panel
            } else {
                // If no thread exists, prompt to create a new chat
                if (confirm(`No chat thread exists for Client ID ${clientId}. Would you like to create a new chat?`)) {
                    document.getElementById('create-chat-modal').style.display = 'flex';
                    document.getElementById('client-id').value = clientId; // Pre-fill client ID
                }
            }
        }, 1000); // Delay to ensure threads are loaded
    }
});