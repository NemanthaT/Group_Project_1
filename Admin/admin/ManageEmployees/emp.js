function hideList(){
    console.log("Hide list called");
    document.getElementById('results').style.display = "block";
    document.getElementById('dA').style.display = "none";
    console.log("Hide list changed");
}

function closeView(){
    document.getElementById('hiddenView').style.display = "none";
    document.getElementById('overlay').style.display = "none";
    document.getElementById('displayArea').style.filter = "none";
}

function closeView(){
    document.getElementById('results').style.display = "none";
    document.getElementById('dA').style.display = "block";
}

function closeForm(){
    document.getElementById('addEmp').style.display = "none";
    document.getElementById('mainContent').style.filter = "blur(0px)";
}
function showForm(){
    window.addEventListener('scroll', function() {});
    document.getElementById('addEmp').style.display = "block";
    document.getElementById('mainContent').style.filter = "blur(10px)";
    document.getElementById('addEmp').style.marginTop = window.scrollY + "px";
}

window.addEventListener('scroll', function() {
    document.getElementById('addEmp').style.marginTop = window.scrollY + "px";
});

/*window.onload = function() {
    hideList();
};*/

function findW(id) {
    document.getElementById('overlay').style.display = "block";

    const preloader = document.getElementById('popupPreloader');
    preloader.classList.remove('fade-out');
    preloader.style.display = "flex";

    fetch('findW.php', {
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

            console.log('profile path: ' + data.profile_image);
            document.getElementById("cId").innerText = data.worker_id;
            document.getElementById("uName").innerText = data.username;
            document.getElementById("fName").innerText = data.full_name;
            document.getElementById("email").innerText = data.email;
            document.getElementById("role").innerText = data.role;
            document.getElementById("address").innerText = "📍 " + data.address;
            document.getElementById("hiddenViewActions").innerHTML = `
                <button class="del" onclick="deleteSp(${data.worker_id})">Delete</button>
            `;
        }
    })
    .catch(error => console.error('Error fetching provider data:', error));
}


//function to use the displayError function from common.js
function getError(file, formData){
    fetch(file , {
        method: "POST",
        body: formData
      })
    .then(response => response.json())
    .then(data=>{
        displayError(data.noticeType, data.error_message, "mainContent");
        console.log("Data received from server");
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

function deleteSp(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        fetch('rmEmp.php', {
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
//Function to list the searched users
window.onload = function() {
    document.getElementById("searchForm").addEventListener("submit", function(e) {
        e.preventDefault(); // prevent full page reload
        hideList();
        var formData = new FormData(this);

      
        fetch("srchEmp.php", {
          method: "POST",
          body: formData
        })
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#displayArea tbody");
            tableBody.innerHTML = '';
            console.log(data);
            if (data === "error") {
                console.log("No data");
                tableBody.innerHTML = '<tr><td colspan="3"><center>No results found</center></td></tr>';
            }
            else{
                console.log("Data");
                data.forEach(item => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${item.full_name}</td>
                    <td>${item.email}</td>
                    <td>${item.role}</td>
                `;
                tableBody.appendChild(row);
                });
            }
        })
        .catch(error => {
          console.error("Error:", error);
        });
    });

    document.getElementById("fm").addEventListener("submit", function(e) {
        //e.preventDefault(); // prevent full page reload
        var formData = new FormData(this);
 
        getError("addEmp.php", formData);      
    });

    /*document.getElementById("removeForm").addEventListener("submit", function(e) {
        e.preventDefault(); // prevent full page reload
        var formData = new FormData(this);
 
        getError("rmEmp.php", formData);      
    });

    document.getElementById("changeForm").addEventListener("submit", function(e) {
        e.preventDefault(); // prevent full page reload
        var formData = new FormData(this);

        getError("chgEmp.php", formData);      
    }); */
};