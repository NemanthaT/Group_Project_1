window.addEventListener("load", function () {
  const preloader = document.getElementById("preloader");
  preloader.classList.add("fade-out");

  setTimeout(() => {
    preloader.remove(); // or preloader.style.display = "none";
  }, 500); // match transition duration
});

function showView(forumData) {
    const popup = document.getElementById("hiddenView");
    const preloader = document.getElementById("popupPreloader");
  
    // Show the popup and preloader
    popup.style.display = "block";
    preloader.classList.remove("fade-out");
  
    // Simulate loading content (or fetch data here)
    setTimeout(() => {
      // Fill content (example)
      document.getElementById("forumId").textContent = "Forum ID: " + forumData.id;
      document.getElementById("forumTitle").textContent = "Title: " + forumData.title;
      document.getElementById("createdBy").textContent = "Created By: " + forumData.createdBy;
      document.getElementById("clientId").textContent = "Client ID: " + forumData.clientId;
      document.getElementById("forumContent").textContent = forumData.content;
  
      // Hide the preloader with animation
      preloader.classList.add("fade-out");
  
      // Optional: remove loader completely after fade
      setTimeout(() => {
        preloader.style.display = "none";
      }, 500); // match the transition time
    }, 500); // simulate a short loading delay
  }