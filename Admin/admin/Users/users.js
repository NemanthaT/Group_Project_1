function viewClient(id) {
    // Send an AJAX request to the PHP script
    fetch('cView.php', {
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
            // Display forum details in the designated area
            document.getElementById('hiddenView').style.display = "block";
            document.getElementById("cId").innerText = data.client_id;
            document.getElementById("uName").innerText = data.username;
            document.getElementById("fName").innerText = data.full_name;
            document.getElementById("email").innerText = data.email;
            document.getElementById("address").innerText = data.address;
            document.documentElement.scrollTop = 0;
        }
    })
    .catch(error => console.error('Error fetching forum data:', error));
}

function deleteClient(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        // Proceed with delete action
            // Send an AJAX request to the PHP script
        fetch('cDelete.php', {
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
        .catch(error => console.error('Error deleting client:', error));
        alert("Item deleted.");
        window.location.href = 'clients.php';
    } else {
        // Do nothing
        alert("Delete canceled.");
    }

}

//
function viewSp(id) {
    // Send an AJAX request to the PHP script
    fetch('spView.php', {
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
            // Display forum details in the designated area
            document.getElementById('hiddenView').style.display = "block";
            document.getElementById("spId").innerText = data.provider_id;
            document.getElementById("uName").innerText = data.username;
            document.getElementById("fName").innerText = data.full_name;
            document.getElementById("email").innerText = data.email;
            document.getElementById("address").innerText = data.address;
            document.getElementById("specialty").innerText = data.speciality;
            document.getElementById("field").innerText = data.field;
            document.documentElement.scrollTop = 0;
        }
    })
    .catch(error => console.error('Error fetching forum data:', error));
}

function deleteSp(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        // Proceed with delete action
            // Send an AJAX request to the PHP script
        fetch('spDelete.php', {
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
        .catch(error => console.error('Error deleting client:', error));
        alert("Item deleted.");
        window.location.href = 'serviceProviders.php';
    } else {
        // Do nothing
        alert("Delete canceled.");
    }

}

function closeView(){
    document.getElementById('hiddenView').style.display = "none";
}