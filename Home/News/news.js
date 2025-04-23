let currentPage = 1;
const itemsPerPage = 8;
let totalNewsCount = 0;

function getNews(page = 1) {
  const newsContainer = document.getElementById("news");
  const preloader = document.getElementById("preloader");
  const offset = (page - 1) * itemsPerPage;

  // Show preloader and clear news
  preloader.style.display = "flex";
  newsContainer.innerHTML = "";

  fetch("countNews.php")
    .then((response) => response.json())
    .then((count) => {
      totalNewsCount = count;
      return fetch("fetchNews.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `offset=${offset}`,
      });
    })
    .then((response) => response.json())
    .then((data) => {
      preloader.style.display = "none"; // Hide preloader

      if (data === "error" || data.length === 0) {
        newsContainer.innerHTML = "<p><center>No news found</center></p>";
      } else {
        data.forEach((item) => {
          const newsItem = document.createElement("div");
          newsItem.className = "news-item";

          const newsImage = document.createElement("div");
          newsImage.className = "news-image";

          const newsContent = document.createElement("div");
          newsContent.className = "news-content";
          newsContent.innerHTML = `<h2>${item.title}</h2>
                                     <button id="seeMBtn" onclick="viewNews(${item.id})">See more</button>`;

          newsItem.appendChild(newsImage);
          newsItem.appendChild(newsContent);
          newsContainer.appendChild(newsItem);
        });
      }

      updatePaginationControls();
    })
    .catch((error) => {
      preloader.style.display = "none";
      console.error("Error:", error);
      newsContainer.innerHTML = "<p><center>Error loading news</center></p>";
    });
}

function updatePaginationControls() {
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");
  const pageInfo = document.getElementById("pageInfo");

  // Calculate total pages
  const totalPages = Math.ceil(totalNewsCount / itemsPerPage);

  // Update buttons
  prevBtn.disabled = currentPage <= 1;
  nextBtn.disabled = currentPage >= totalPages;

  // Update page info
  pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
}

function nextPage() {
  const totalPages = Math.ceil(totalNewsCount / itemsPerPage);
  if (currentPage < totalPages) {
    currentPage++;
    getNews(currentPage);
  }
}

function prevPage() {
  if (currentPage > 1) {
    currentPage--;
    getNews(currentPage);
  }
}

window.onload = function () {
  getNews(currentPage);
};

function viewNews(id) {
  console.log("Fetching news details for ID:", id);

  // Show the modal and overlay
  document.getElementById("view").style.display = "flex";
  document.getElementById("overlay").style.display = "block";

  fetch("getNews.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `id=${id}`,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      if (data === "error" || !data) {
        throw new Error("Error in response data");
      } else {
        document.getElementById("newsTitle").innerText = data.title;
        document.getElementById("newsDescription").innerHTML = data.content;
        document.getElementById("newsDate").innerText = new Date(
          data.created_at
        ).toLocaleDateString();
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Error fetching news details. Please try again.");
      closeView(); // Close the modal on error
    });
}

function closeView() {
  document.getElementById("view").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}
