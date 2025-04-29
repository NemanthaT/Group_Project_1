function viewClient(id) {
    document.getElementById('overlay').style.display = "block";

    const preloader = document.getElementById('popupPreloader');
    preloader.classList.remove('fade-out');
    preloader.style.display = "flex";

    fetch('cView.php', {
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
            console.log(data);

            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = "none";
            }, 500);

            window.addEventListener('scroll', function() {});
            document.getElementById('displayArea').style.filter = "blur(10px)";
            document.getElementById('hiddenView').style.display = "block";
            document.getElementById('hiddenView').style.marginTop = window.scrollY + "px";

            document.getElementById("cId").innerText = data.client_id;
            document.getElementById("uName").innerText = data.username;
            document.getElementById("fName").innerText = data.full_name;
            document.getElementById("email").innerText = data.email;
            document.getElementById("address").innerText = "📍 " + data.address;
            document.getElementById("hiddenViewActions").innerHTML = `
                <button class="del" onclick="deleteClient(${data.client_id})">Delete</button>
            `;
        }
    })
    .catch(error => console.error('Error fetching client data:', error));
}

function deleteClient(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        fetch('cDelete.php', {
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
            }
        })
        .catch(error => console.error('Error deleting client:', error));
        alert("Item deleted.");
        window.location.href = 'clients.php';
    } else {
        alert("Delete canceled.");
    }
}

function viewSp(id) {
    document.getElementById('overlay').style.display = "block";

    const preloader = document.getElementById('popupPreloader');
    preloader.classList.remove('fade-out');
    preloader.style.display = "flex";

    fetch('spView.php', {
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
            preloader.classList.add('fade-out');
            setTimeout(() => {
                preloader.style.display = "none";
            }, 500);

            window.addEventListener('scroll', function() {});
            document.getElementById('displayArea').style.filter = "blur(10px)";
            document.getElementById('hiddenView').style.display = "block";
            document.getElementById('hiddenView').style.marginTop = window.scrollY + "px";

            document.querySelector("#userPic img").src = data.profile_image;
            console.log('profile path: ' + data.profile_image);
            document.getElementById("spId").innerText = data.provider_id;
            document.getElementById("uName").innerText = data.username;
            document.getElementById("fName").innerText = data.full_name;
            document.getElementById("email").innerText = data.email;
            document.getElementById("address").innerText = "📍 " + data.address;
            document.getElementById("specialty").innerText = data.speciality;
            document.getElementById("field").innerText = data.field;
            document.getElementById("hiddenViewActions").innerHTML = `
                <button class="del" onclick="deleteSp(${data.provider_id})">Delete</button>
            `;
        }
    })
    .catch(error => console.error('Error fetching provider data:', error));
}

function deleteSp(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        fetch('spDelete.php', {
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
            } else {
                location.reload();
            }
        })
        .catch(error => console.error('Error deleting client:', error));
        alert("Item deleted.");
        window.location.href = 'serviceProviders.php';
    } else {
        alert("Delete canceled.");
    }
}

function closeView(){
    document.getElementById('hiddenView').style.display = "none";
    document.getElementById('overlay').style.display = "none";
    document.getElementById('displayArea').style.filter = "none";
}

window.addEventListener('scroll', function() {
    document.getElementById('hiddenView').style.marginTop = window.scrollY + "px";
});

function showDete(){
    if(document.getElementById('dContent').style.display == "block"){
        document.getElementById('dContent').style.display = "none";
    }
    else{
        document.getElementById('dContent').style.display = "block";
    }
}

function changeF(uType){
    document.getElementById('dContent').style.display = "none";
    
    document.getElementById('dBtn').innerText=uType;
    if(uType == "Choose"){
        window.location.href = 'serviceProviders.php';
    }

    else{
        if(uType == "Trainers"){
            uType = "Trainer";
        }
        else if(uType == "Consultants"){
            uType = "Consultant";
        }
        else if(uType == "Researchers"){
            uType = "Researcher";
        } 
        fetch('listC.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'utype=' + encodeURIComponent(uType)
        })
        
        .then(response => response.json())

        .then(data => {
            const tableBody = document.querySelector("#dTable tbody");
            tableBody.innerHTML = '';

            data.forEach(item => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${item.username}</td>
                <td>${item.email}</td>
                <td>${item.speciality}</td>
                <td class="actions"><center><button class="view" onclick="viewSp('${item.provider_id}')">View</button>
                <button class="del" onclick="deleteSp('${item.provider_id}')">Delete</button></center></td>
            `;
            tableBody.appendChild(row);
            });
        })
    }
}
