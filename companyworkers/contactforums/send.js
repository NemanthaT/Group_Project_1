window.onload = function() {
    document.getElementById("send_Response").addEventListener("submit", function(e) {
        e.preventDefault(); // prevent full page reload
        var formData = new FormData(this);
        const data = {};
        data['email'] = formData.get('sendMail'); // Match the input name
        data['subject'] = 'Reply to your request';
        data['message'] = formData.get('response_message'); // Match the textarea name
        console.log('data:' + data['email']);
        console.log('data' + data['message']);
        console.log('data' + data['subject']);

        fetch("http://localhost/Group_Project_1/sendemail/send.php", {
            method: "POST",
            body: `data=${JSON.stringify(data)}`,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
        })
        .then((response) => response.text())
        .then((result) => {
            console.log("Email result:", result);
            alert("Email sent");
        })
    });
}