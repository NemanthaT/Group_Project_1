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

function clearSearch() {
  const input = document.getElementById("searchInput");
  const threads = document.querySelectorAll("#thread-list li");
  input.value = ""; 
  threads.forEach(thread => {
      thread.style.display = ""; 
  });
}
  
function viewThread(title, content, views, replies) {
  document.getElementById("modalTitle").textContent = title
  document.getElementById("modalContent").textContent = content
  document.getElementById("modalViews").textContent = views + " views"
  document.getElementById("modalReplies").textContent = replies + " replies"
  
  document.getElementById("modalOverlay").style.display = "block"
  document.getElementById("modalForm").style.display = "flex"
}
  
function closeModal() {
  document.getElementById("modalForm").style.display = "none"
  document.getElementById("modalOverlay").style.display = "none"
}
  
function openCreateThreadModal() {
  document.getElementById("createThreadModalOverlay").style.display = "block"
  document.getElementById("createThreadModal").style.display = "flex"
}
  
function closeCreateThreadModal() {
  document.getElementById("createThreadModalOverlay").style.display = "none"
  document.getElementById("createThreadModal").style.display = "none"
}