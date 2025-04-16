window.onload = function() {
    const newsContainer = document.getElementById('news');
    fetch("fetchNews.php", {
        method: "POST"
    })
    .then(response => response.json())
    .then(data => {
        const newsContainer = document.getElementById('news');
        console.log(data);
        if (data === "error") {
            console.log("No data");
            newsContainer.innerHTML = '<p><center>No results found</center><p>';
        }
        else{

            data.forEach(item => {
                const newsItem = document.createElement('div');
                newsItem.className = 'news-item';
                // Create the .news-image div
                const newsImage = document.createElement('div');
                newsImage.className = 'news-image';

                // Create the .news-content div
                const newsContent = document.createElement('div');
                newsContent.className = 'news-content';

                // Add content to newsContent
                newsContent.innerHTML = `<h2>${item.title}</h2>`;

                // Append the new divs to the #news Item div
                newsItem.appendChild(newsImage);
                newsItem.appendChild(newsContent);

                // Append the newto the #news container
                newsContainer.appendChild(newsItem);

            });

        }
    })

}