function closeView(){
    document.getElementById('results').style.display = "none";
}

function closeForm(){
    document.getElementById('addEmp').style.display = "none";
    document.getElementById('main').style.filter = "blur(0px)";
}
function showForm(){
    document.getElementById('addEmp').style.display = "block";
    document.getElementById('main').style.filter = "blur(10px)";
}