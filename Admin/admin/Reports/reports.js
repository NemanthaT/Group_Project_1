function closeView() {
  document.getElementById("searchResults").style.display = "none";
}

window.onload = function () {
  document
    .getElementById("searchForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      var formData = new FormData(this);

      fetch("getBillDt.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          const tableBody = document.querySelector("#mainT tbody");
          tableBody.innerHTML = "";
          if (data === "nodata") {
            tableBody.innerHTML =
              '<tr><td colspan="4"><center>No results found</center></td></tr>';
          } else {
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
    e.preventDefault();

    const sStatus = document.getElementById("filterS").value;
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

        tableBody.innerHTML = "";
        if (data === "nodata") {
          tableBody.innerHTML =
            '<tr><td colspan="4"><center>No results found</center></td></tr>';
        } else {
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
