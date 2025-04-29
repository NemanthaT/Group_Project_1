window.addEventListener("load", function () {
  const preloader = document.getElementById("preloader");
  preloader.classList.add("fade-out");

  setTimeout(() => {
    preloader.remove();
  }, 500);
});