// Function to search for topics in the forum
function searchTopics() {
    const query = document.getElementById("search-input").value.toLowerCase();
    const threads = document.querySelectorAll("#thread-list li");
    threads.forEach(thread => {
        const title = thread.querySelector("h4").textContent.toLowerCase();
        if (title.includes(query)) {
            thread.style.display = "";
        } else {
            thread.style.display = "none";
        }
    });
}

// Function to filter threads by category
function filterByCategory(category) {
    const threads = document.querySelectorAll("#thread-list li");
    threads.forEach(thread => {
        if (thread.getAttribute("data-category") === category) {
            thread.style.display = "";
        } else {
            thread.style.display = "none";
        }
    });
}

// Function to add a new thread
function addThread() {
    const title = document.getElementById("thread-title").value;
    const category = document.getElementById("thread-category").value;

    if (title && category) {
        const threadList = document.getElementById("thread-list");
        const newThread = document.createElement("li");
        newThread.setAttribute("data-category", category);
        newThread.innerHTML = `
            <h4>${title}</h4>
            <p>Started by <span class="username">You</span> - 0 replies</p>
        `;
        threadList.appendChild(newThread);

        // Clear input fields
        document.getElementById("thread-title").value = "";
    } else {
        alert("Please enter a thread title and select a category.");
    }
}

// Function to display the modal with thread details
function viewThread(title, content, views, replies) {
    // Populate the modal with thread details
    document.getElementById('modalTitle').value = title;
    document.getElementById('modalContent').value = content;
    document.getElementById('modalViews').value = views + " views";
    document.getElementById('modalReplies').value = replies + " replies";

    // Display the modal and overlay
    document.getElementById('modalOverlay').style.display = 'block';
    document.getElementById('modalForm').style.display = 'block';
}

// Function to close the modal
function closeModal() {
    document.getElementById('modalForm').style.display = 'none';
    document.getElementById('modalOverlay').style.display = 'none';
}


// Function to delete a thread
function deleteThread(threadId) {
    const threadElement = document.getElementById(threadId);
    if (threadElement) {
        // Confirm before deletion
        const confirmation = confirm('Are you sure you want to delete this thread?');
        if (confirmation) {
            threadElement.remove();
            alert('Thread deleted successfully.');
        }
    } else {
        alert('Thread not found.');
    }
}

// Function to open the "Create New Thread" modal
function openCreateThreadModal() {
    document.getElementById('createThreadModalOverlay').style.display = 'block';
    document.getElementById('createThreadModal').style.display = 'block';
}

// Function to close the "Create New Thread" modal
function closeCreateThreadModal() {
    document.getElementById('createThreadModalOverlay').style.display = 'none';
    document.getElementById('createThreadModal').style.display = 'none';
}

// Function to submit a new thread
function submitNewThread() {
    const title = document.getElementById("newThreadTitle").value;
    const category = document.getElementById("newThreadCategory").value;
    const message = document.getElementById("newThreadMessage").value;

    if (title && category && message) {
        const threadList = document.getElementById("thread-list");
        const newThread = document.createElement("li");
        newThread.setAttribute("data-category", category);
        newThread.innerHTML = `
            <h4>${title}</h4>
            <p>Started by <span class="username">You</span> - 0 replies</p>
            <button class="view-btn" onclick="viewThread('${title}', '${message}', 0, 0)">View</button>
            <button class="delete-btn" onclick="deleteThread('${Date.now()}')">Delete</button>
        `;
        threadList.appendChild(newThread);

        // Close modal and clear input fields
        closeCreateThreadModal();
        document.getElementById("newThreadTitle").value = "";
        document.getElementById("newThreadMessage").value = "";
    } else {
        alert("Please fill in all fields before creating a thread.");
    }
}
