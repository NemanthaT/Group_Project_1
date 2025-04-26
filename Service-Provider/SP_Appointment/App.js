function filterAndSortAppointments() {
  // Commented out for future reference: Filter by Appointment ID or Client Name
  // const clientFilter = document.getElementById("clientFilter")?.value.trim().toLowerCase() || "";
  const appointmentDateFilter = document.getElementById("appointmentDateFilter")?.value || "";
  const statusFilter = document.getElementById("statusSort")?.value.toLowerCase() || "";

  const tbody = document.getElementById("appointment-tbody");
  const rows = Array.from(tbody.querySelectorAll("tr"));

  rows.forEach((row) => {
    const clientNameCell = row.children[0]?.textContent.trim().toLowerCase(); // Client Name (not used for filtering)
    const appointmentDateCell = row.children[1]?.textContent.trim(); // Appointment Date
    const statusCell = row.children[2]?.textContent.trim().toLowerCase(); // Status

    let showRow = true;

    // Commented out for future reference: Filter by Appointment ID or Client Name
    // if (clientFilter && !clientNameCell.includes(clientFilter)) {
    //   showRow = false;
    // }

    // Filter by Appointment Date only
    if (appointmentDateFilter && appointmentDateCell) {
      // Extract only the date part from the cell
      const rowDate = appointmentDateCell.split(" ")[0]; // Takes "2024-11-25" from "2024-11-25"
      if (rowDate !== appointmentDateFilter) {
        showRow = false;
      }
    }

    // Filter by Status only
    if (statusFilter && statusCell !== statusFilter) {
      showRow = false;
    }

    row.style.display = showRow ? "" : "none";
  });
}

function clearFilters() {
  // Commented out for future reference: Clear Client Name filter
  // document.getElementById("clientFilter").value = "";
  document.getElementById("appointmentDateFilter").value = "";
  document.getElementById("statusSort").value = "";

  filterAndSortAppointments(); // Reapply filtering to reset the table
}
