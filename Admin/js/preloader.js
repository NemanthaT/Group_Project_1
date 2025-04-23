window.addEventListener("load", function () {
  const preloader = document.getElementById("preloader");
  preloader.classList.add("fade-out");

  setTimeout(() => {
    preloader.remove(); // or preloader.style.display = "none";
  }, 500); // match transition duration
});