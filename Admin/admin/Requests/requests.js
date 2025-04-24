function viewReq(id) {
  document.getElementById("overlay").style.display = "block";

  // Show preloader
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

        // Hide preloader with fade out
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
    // Proceed with delete action
    // Send an AJAX request to the PHP script
    fetch("delete_req.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `id=${id}`,
    })
      .then((response) => response.json())
      .then((data) => {
        // Check if data contains error
        if (data.error) {
          alert(data.error);
        } else {
          // Reload the page
          location.reload();
        }
      })
      .catch((error) => console.error("Error deleting forum:", error));
    alert("Item deleted.");
    //location.reload();
    window.location.href = "requests.php";
  } else {
    // Do nothing
    alert("Delete canceled.");
  }
}

// Function to accept the request and send an email
function accReq(id) {
    if (confirm("Do you want to accept the request?")) {
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
          alert(data.error);
        } else {
          return fetch("http://localhost/Group_Project_1/sendemail/send.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `data=${JSON.stringify(data)}`, // Properly stringify the data
          });
        }
      })
      .then((response) => response.text()) // Change to text() since send.php returns HTML/JS
      .then((result) => {
        console.log("Email result:", result);
        alert("Request accepted and email sent");
        window.location.href = "requests.php";
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Request accepted but email failed to send");
        window.location.href = "requests.php";
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
