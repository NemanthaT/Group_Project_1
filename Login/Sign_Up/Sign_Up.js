function closeError() {
  document.getElementById("errorView").style.display = "none";
  document.getElementById("overlay").style.display = "none";
  location.reload();
}
window.onload = function () {
  if(document.getElementById("signup-form")){
      //Add a client
      document.getElementById("signup-form").addEventListener("submit", function (e) {
        e.preventDefault(); // prevent full page 
        const sBtn = document.getElementById("submit-btn");
        sBtn.disabled = true;
        sBtn.innerText = 'Processing...';
        var formData = new FormData(this);

        fetch("addClient.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            document.getElementById("errorView").style.display = "block";
            document.getElementById("overlay").style.display = "block";
            if (data.popup_type == "error") {
              document.querySelector("#errorView .error-title").innerHTML =
                data.popup_title;
              document.querySelector("#errorView .error-title").style.color =
                "red";
            }
            if (data.popup_type == "success") {
              document.querySelector("#errorView .error-title").innerHTML =
                data.popup_title;
              document.querySelector("#errorView .error-title").style.color =
                "green";
            }
            document.querySelector("#errorView .error-message").innerHTML =
              data.popup_message;
          })
          .catch((error) => {
            console.error("Error: " + error);
            document.getElementById("errorView").style.display = "block";
            document.getElementById("overlay").style.filter = "block";
            document.querySelector("#errorView .error-title").innerHTML = "Error";
            document.querySelector("#errorView .error-title").style.color = "red";
            document.querySelector("#errorView .error-message").innerHTML =
              "Error occured in connection";
          })
          .finally(() => {
              sBtn.disabled = false;
              sBtn.innerText = 'Sign up';
          });
      });


  }
  else {
      //Add a provider
      document.getElementById("signup-form2").addEventListener("submit", function (e) {
        e.preventDefault(); // prevent full page 
        const sBtn = document.getElementById("submit-btn");
        sBtn.disabled = true;
        sBtn.innerText = 'Processing...';
        var formData = new FormData(this);
  
        fetch("addProvider.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            document.getElementById("errorView").style.display = "block";
            document.getElementById("overlay").style.display = "block";
            if (data.popup_type == "error") {
              document.querySelector("#errorView .error-title").innerHTML =
                data.popup_title;
              document.querySelector("#errorView .error-title").style.color =
                "red";
            }
            if (data.popup_type == "success") {
              document.querySelector("#errorView .error-title").innerHTML =
                data.popup_title;
              document.querySelector("#errorView .error-title").style.color =
                "green";
            }
            document.querySelector("#errorView .error-message").innerHTML =
              data.popup_message;
          })
          .catch((error) => {
            console.error("Error: " + error);
            document.getElementById("errorView").style.display = "block";
            document.getElementById("overlay").style.filter = "block";
            document.querySelector("#errorView .error-title").innerHTML = "Error";
            document.querySelector("#errorView .error-title").style.color = "red";
            document.querySelector("#errorView .error-message").innerHTML =
              "Error occured in connection";
          })
          .finally(() => {
              sBtn.disabled = false;
              sBtn.innerText = 'Sign up';
          });
      });
  }


};
