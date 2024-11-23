function viewReq(id) {
    // Send an AJAX request to the PHP script
    fetch('view_req.php', {
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
            // Display forum details in the hidden area
            window.addEventListener('scroll', function() {});
            document.getElementById('displayArea').style.filter = "blur(10px)";
            document.getElementById('hiddenView').style.display = "block";
            document.getElementById('hiddenView').style.marginTop = window.scrollY + "px";
            document.getElementById("reqId").innerText = data.reqId;
            document.getElementById("reqName").innerText = data.full_name;
            document.getElementById("reqEmail").innerText = data.email;
            document.getElementById("reqTel").innerText = data.phone;
            document.getElementById("reqField").innerText = data.field;
            document.getElementById("reqSpec").innerText = data.specialty;
            //document.documentElement.scrollTop = 0;
        }
    })
    .catch(error => console.error('Error fetching forum data:', error));
}

function deleteReq(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        // Proceed with delete action
            // Send an AJAX request to the PHP script
        fetch('delete_req.php', {
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
        //location.reload();
        window.location.href = 'requests.php';
    } else {
        // Do nothing
        alert("Delete canceled.");
    }

}

//accept requests
function accReq(id) {
    if (confirm("Do you want to accept the request?")) {
        // Proceed with accept action
            // Send an AJAX request to the PHP script
        fetch('acc_req.php', {
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
        .catch(error => console.error('Error Accepting Request:', error));
        alert("Request Accepeted.");
        window.location.href = 'requests.php';
    } else {
        // Do nothing
        alert("Accepting canceled.");
    }

}

function closeView(){
    document.getElementById('hiddenView').style.display = "none";
    document.getElementById('displayArea').style.filter = "blur(0px)";
}