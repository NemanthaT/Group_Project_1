function viewReq(id) {
  document.getElementById("overlay").style.display = "block";

  
  const preloader = document.getElementById("popupPreloader");
  preloader.classList.remove("fade-out");
  preloader.style.display = "flex";

  fetch("view_req.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `id=${id}`,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        alert(data.error);
      } else {
        window.addEventListener("scroll", function () {});
        document.getElementById("displayArea").style.filter = "blur(10px)";
        const popup = document.getElementById("hiddenView");
        popup.style.display = "block";
        popup.style.marginTop = window.scrollY + "px";

        document.getElementById("reqId").innerText = data.reqId;
        document.getElementById("reqName").innerText = data.full_name;
        document.getElementById("reqEmail").innerText = data.email;
        document.getElementById("reqTel").innerText = data.phone;
        document.getElementById("reqField").innerText = data.field;
        document.getElementById("reqSpec").innerText = data.specialty;
        document.getElementById("hiddenViewActions").innerHTML = `
                <button class="accept" onclick="accReq(${data.reqId})">Accept</button>
                <button class="del" onclick="deleteReq(${data.reqId})">Delete</button>
            `;

        
        preloader.classList.add("fade-out");
        setTimeout(() => {
          preloader.style.display = "none";
        }, 500);
      }
    })
    .catch((error) => console.error("Error fetching request data:", error));
}

function deleteReq(id) {
  if (confirm("Are you sure you want to delete this item?")) {
    
    fetch("delete_req.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `id=${id}`,
    })
      .then((response) => response.json())
      .then((data) => {
        
        if (data.error) {
          alert(data.error);
        } else {
          
          location.reload();
        }
      })
      .catch((error) => console.error("Error deleting forum:", error));
    alert("Item deleted.");
    
    window.location.href = "requests.php";
  } else {
    
    alert("Delete canceled.");
  }
}


function accReq(id) {
  if (confirm("Do you want to accept the request?")) {
    
    const preloader = document.getElementById("popupPreloader");
    preloader.classList.remove("fade-out");
    preloader.style.display = "flex";

    fetch("acc_req.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `id=${id}`,
    })
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        throw new Error(data.error);
      } else {
        return fetch("http://localhost/Group_Project_1/sendemail/send.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `data=${JSON.stringify(data)}`,
        });
      }
    })
    .then((response) => response.text())
    .then((result) => {
      console.log("Email result:", result);
      alert("Request accepted and email sent");
      window.location.href = "requests.php";
    })
    .catch((error) => {
      console.error("Error:", error);
      alert(error.message || "Request accepted but email failed to send");
      window.location.href = "requests.php";
    })
    .finally(() => {
      
      preloader.classList.add("fade-out");
      setTimeout(() => {
        preloader.style.display = "none";
      }, 500);
    });
  } else {
    alert("Accepting canceled.");
  }
}


window.addEventListener("scroll", function () {
  document.getElementById("hiddenView").style.marginTop = window.scrollY + "px";
});

function closeView() {
  document.getElementById("hiddenView").style.display = "none";
  document.getElementById("overlay").style.display = "none";
  document.getElementById("displayArea").style.filter = "blur(0px)";
}
