function closeView() {
  document.getElementById("searchResults").style.display = "none";
}

window.onload = function () {
  document
    .getElementById("searchForm")
    .addEventListener("submit", function (e) {
      e.preventDefault(); // prevent full page reload
      var formData = new FormData(this);

      fetch("getBillDt.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          const tableBody = document.querySelector("#mainT tbody");
          tableBody.innerHTML = "";
          console.log(data);
          if (data === "nodata") {
            console.log("No data");
            tableBody.innerHTML =
              '<tr><td colspan="3"><center>No results found</center></td></tr>';
          } else {
            console.log("Data");
            data.forEach((item) => {
              const row = document.createElement("tr");
              row.innerHTML = `
                    <td>${item.Description}</td>
                    <td>${item.Bill_Date}</td>
                    <td>RS.${item.Amount}.00</td>
                    <td>${item.paid_on}</td>
                `;
              tableBody.appendChild(row);
            });
          }
        });
    });

  document.getElementById("filterS").addEventListener("change", function (e) {
    e.preventDefault(); // prevent full page reload

    const sStatus = document.getElementById("filterS").value;
    console.log("Status:", sStatus); // Check the value of sStatus
    var formData = new FormData();
    formData.append("status", sStatus);

    fetch("getUnpaid.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        if (data === "paid") {
            location.reload();
            exit();
        }
        console.log("Success:", data);
        const tableContainer = document.getElementById("mainT");
        const tableBody = tableContainer.querySelector("tbody");
        const tableHeader = tableContainer.querySelector("thead");
        tableHeader.innerHTML = "";
        const headerRow = document.createElement("tr");
        headerRow.innerHTML = `
                                <th>Description</th>
                                <th>Bill Date</th>
                                <th>Amount</th>
                            `;
        tableHeader.appendChild(headerRow);

        tableBody.innerHTML = ""; // Clear previous results
        if (data === "nodata") {
          console.log("No data");
          tableBody.innerHTML =
            '<tr><td colspan="4"><center>No results found</center></td></tr>';
        } else {
          console.log("Data");
          data.forEach((item) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                    <td>${item.Description}</td>
                    <td>${item.Bill_Date}</td>
                    <td>RS.${item.Amount}.00</td>
                `;
            tableBody.appendChild(row);
          });
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });
};