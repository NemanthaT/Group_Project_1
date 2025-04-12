function hideList(){
    if(document.getElementById('results').style.display != "none"){
        document.getElementById('dA').style.display = "none";
    }
    else{
        document.getElementById('dA').style.display = "block";
    }
    
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

window.onload = function() {
    hideList();
};