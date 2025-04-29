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

        document.getElementById("thread-title").value = "";
    } else {
        alert("Please enter a thread title and select a category.");
    }
}
