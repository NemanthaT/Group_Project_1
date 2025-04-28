function filterAndSortAppointments() {
  const appointmentDateFilter = document.getElementById("appointmentDateFilter")?.value || "";
  const statusFilter = document.getElementById("statusSort")?.value.toLowerCase() || "";

  const tbody = document.getElementById("appointment-tbody");
  const rows = Array.from(tbody.querySelectorAll("tr"));

  rows.forEach((row) => {
    const clientNameCell = row.children[0]?.textContent.trim().toLowerCase();
    const appointmentDateCell = row.children[1]?.textContent.trim(); 
    const statusCell = row.children[2]?.textContent.trim().toLowerCase();

    let showRow = true;

    if (clientFilter && !clientNameCell.includes(clientFilter)) {
      showRow = false;
    }

    if (appointmentDateFilter && appointmentDateCell) {
      const rowDate = appointmentDateCell.split(" ")[0]; 
      if (rowDate !== appointmentDateFilter) {
        showRow = false;
      }
    }

    if (statusFilter && statusCell !== statusFilter) {
      showRow = false;
    }

    row.style.display = showRow ? "" : "none";
  });
}

function clearFilters() {
  document.getElementById("clientFilter").value = "";
  document.getElementById("appointmentDateFilter").value = "";
  document.getElementById("statusSort").value = "";

  filterAndSortAppointments(); 
}
