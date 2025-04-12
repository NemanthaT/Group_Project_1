function displayError(){
    document.getElementById('errorView').style.display = "block";
    document.getElementById('form-section').style.filter = "blur(10px)";
}

function closeError(){
    document.getElementById('errorView').style.display = "none";
    document.getElementById('form-section').style.filter = "blur(0px)";
}