function paymentGateway(bill_id) {
  // Payment gateway logic
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      if (confirm("You will directed to the portal!! Are you sure you want to proceed?")) {
        var response = JSON.parse(xhttp.responseText);
        console.log(response); // Log the response for debugging

        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);
          // Note: validate the payment and show success or failure page to the customer

          //Send request to update the payment status in the database
          const data = {
            project_id: response["order_id"],
          };

          fetch("process.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
          })
            .then(response => response.text())
            .then(result => {
              console.log("Response from PHP:", result);
            })
            .catch(error => {
              console.error("Error:", error);
            });

        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };
        // Seperate the name of the customer
        var fullName = response["fullname"];
        var [firstName, lastName] = fullName.split(" ");
        // Put the payment variables here
        var payment = {
          "sandbox": true,
          "merchant_id": response["merchant_id"], // Replace with your Merchant ID retrieved from backend
          "return_url": "http://localhost/Group_Project_1/payment/sample.php",     // Important
          "cancel_url": "http://localhost/Group_Project_1/payment/sample.php",     // Important
          "notify_url": "http://sample.com/notify",
          "order_id": response["order_id"], // *Replace with generated order ID retrieved from backend
          "items": response["items"], // *Replace with generated items retrieved from backend
          "amount": response["amount"], // *Replace with generated amount retrieved from backend
          "currency": response["currency"], // *Replace with generated currency retrieved from backend
          "hash": response["hash"], // *Replace with generated hash retrieved from backend
          "first_name": firstName,
          "last_name": lastName,
          "email": response["email"], // *Replace with generated email retrieved from backend
          "phone": response["phone"], // *Replace with generated phone retrieved from backend,
          "address": response["address"], // *Replace with generated address retrieved from backend
          "city": "Undefined",
          "country": "Sri Lanka",
          "delivery_address": "No. 46, Galle road, Kalutara South",
          "delivery_city": "Kalutara",
          "delivery_country": "Sri Lanka",
          "custom_1": "",
          "custom_2": ""
        };

        payhere.startPayment(payment);
      }
      else {
        // Do nothing
        alert("Delete canceled.");
      }
    }
  };
  xhttp.open("GET", "http://localhost/Group_project_1/payment/pay.php?" + bill_id, true);
  xhttp.send();
}