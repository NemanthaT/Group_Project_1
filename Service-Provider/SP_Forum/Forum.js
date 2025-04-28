// Function to search for topics in the forum
function searchTopics() {
  const query = document.getElementById("searchInput").value.toLowerCase();
  const threads = document.querySelectorAll("#thread-list li");
  threads.forEach((thread) => {
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
  threads.forEach((thread) => {
      if (category === "all" || thread.getAttribute("data-category") === category) {
          thread.style.display = "";
      } else {
          thread.style.display = "none";
      }
  });
}

// Function to clear the search and category filters
function clearSearch() {
  const input = document.getElementById("searchInput");
  const threads = document.querySelectorAll("#thread-list li");
  input.value = ""; // Clear the search input
  threads.forEach(thread => {
      thread.style.display = ""; // Show all threads
  });
}
  
// Function to display the modal with thread details
function viewThread(title, content, views, replies) {
  // Populate the modal with thread details
  document.getElementById("modalTitle").textContent = title
  document.getElementById("modalContent").textContent = content
  document.getElementById("modalViews").textContent = views + " views"
  document.getElementById("modalReplies").textContent = replies + " replies"
  
  // Display the modal and overlay
  document.getElementById("modalOverlay").style.display = "block"
  document.getElementById("modalForm").style.display = "flex"
}
  
// Function to close the modal
function closeModal() {
  document.getElementById("modalForm").style.display = "none"
  document.getElementById("modalOverlay").style.display = "none"
}
  
  // Function to open the "Create New Thread" modal
function openCreateThreadModal() {
  document.getElementById("createThreadModalOverlay").style.display = "block"
  document.getElementById("createThreadModal").style.display = "flex"
}
  
// Function to close the "Create New Thread" modal
function closeCreateThreadModal() {
  document.getElementById("createThreadModalOverlay").style.display = "none"
  document.getElementById("createThreadModal").style.display = "none"
}