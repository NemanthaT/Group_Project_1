function viewForum(id) {
    document.getElementById('overlay').style.display = "block";

    // Show preloader immediately
    const preloader = document.getElementById('popupPreloader');
    preloader.classList.remove('fade-out');
    preloader.style.display = "flex";

    fetch('view_forum.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${id}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
            document.documentElement.scrollTop = 0;
        } else {
            window.addEventListener('scroll', function() {});
            document.getElementById('displayArea').style.filter = "blur(10px)";
            const popup = document.getElementById('hiddenView');
            popup.style.display = "block";
            popup.style.marginTop = window.scrollY + "px";

            document.getElementById("forumTitle").innerText = "Title: " + data.title;
            document.getElementById("createdBy").innerText = "Created By: " + data.full_name;
            document.getElementById("createdAt").innerText = "Created At: " + data.created_at;
            document.getElementById("clientId").innerText = "User Id: " + data.user_id;
            document.getElementById("forumContent").innerText = data.content;

            
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = "none";
            }, 500); // match transition duration
        }
    })
    .catch(error => console.error('Error fetching forum data:', error));
}

function deleteForum(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        // Proceed with delete action
            // Send an AJAX request to the PHP script
        fetch('delete_forum.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}`
        })
        .then(response => response.json())
        .then(data => {
            // Check if data contains error
            if (data.error) {
                alert(data.error);
            } else {
                // Reload the page
                location.reload();
            }
        })
        .catch(error => console.error('Error deleting forum:', error));
        alert("Item deleted.");
        window.location.href = 'forums.php';
    } else {
        // Do nothing
        alert("Delete canceled.");
    }

}

function closeView(){
    document.getElementById('hiddenView').style.display = "none";
    document.getElementById('overlay').style.display = "none";
    document.getElementById('displayArea').style.filter = "blur(0px)";
}

window.addEventListener('scroll', function() {
    document.getElementById('hiddenView').style.marginTop = window.scrollY + "px";
});