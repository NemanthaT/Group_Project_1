function hideList(){
    document.getElementById('results').style.display = "block";
    document.getElementById('dA').style.display = "none";
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

//function to use the displayError function from common.js
function showError(file, formData){
    fetch(file , {
        method: "POST",
        body: formData
      })
    .then(response => response.json())
    .then(data=>{
        displayError(data.noticeType, data.error_message, "mainContent");
    })
    .catch(error => {
        console.error("Error:", error);
    });
}

//Function to list the searched users
window.onload = function() {
    document.getElementById("searchForm").addEventListener("submit", function(e) {
        e.preventDefault(); // prevent full page reload
        hideList();
        var formData = new FormData(this);
        console.log(formData);
      
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
                tableBody.innerHTML = '<tr><td colspan="5"><center>No results found</center></td></tr>';
            }
            else{
                console.log("Data");
                data.forEach(item => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${item.worker_id}</td>
                    <td>${item.username}</td>
                    <td>${item.full_name}</td>
                    <td>${item.role}</td>
                    <td>${item.email}</td>
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
        var formData = new FormData(this);
        console.log(formData);
        showError("addEmp.php", formData);      
    });

    document.getElementById("removeForm").addEventListener("submit", function(e) {
        var formData = new FormData(this);
        console.log(formData);
        showError("rmEmp.php", formData);      
    });

    document.getElementById("changeForm").addEventListener("submit", function(e) {
        var formData = new FormData(this);
        console.log(formData);
        showError("chgEmp.php", formData);      
    }); 
};