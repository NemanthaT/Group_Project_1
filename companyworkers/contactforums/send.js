window.onload = function() {
    document.getElementById("send_Response").addEventListener("submit", function(e) {
        e.preventDefault(); // prevent full page reload
        hideList();
        var formData = new FormData(this);
        formData.append('subject', 'Reply to your request');

        fetch("http://localhost/Group_Project_1/sendemail/send.php", {
            method: "POST",
            body: `data=${JSON.stringify(formData)}`,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
        })
        .then((response) => response.text())
        console.log("Email result:", result);
        alert("Request accepted and email sent");

    });
}