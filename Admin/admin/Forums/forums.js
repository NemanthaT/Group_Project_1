function viewForum(id) {
    // Send an AJAX request to the PHP script
    fetch('view_forum.php', {
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
            document.documentElement.scrollTop = 0;
        } else {
            // Display forum details in the hidden area
            document.getElementById('hiddenView').style.display = "block";
            document.getElementById("forumId").innerText = data.forum_id;
            document.getElementById("forumTitle").innerText = data.title;
            document.getElementById("clientId").innerText = data.user_id;
            document.getElementById("forumContent").innerText = data.content;
            document.documentElement.scrollTop = 0;
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
}