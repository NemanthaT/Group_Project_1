// Redirect to the given URL
function redirectTo(url) {
    window.location.href = url;
}

// Load page
function loadPage(url) {
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error('Page not found');
        }
        return response.text();
      })
      .then(data => {
        document.getElementById('frame').innerHTML = data;
      })
      .catch(error => {
        document.getElementById('frame').innerHTML = '<p>Error loading the page</p>';
        console.error('There was an error:', error);
      });
  }