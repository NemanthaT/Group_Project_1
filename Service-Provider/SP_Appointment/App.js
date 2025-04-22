function filterAndSortAppointments() {
  const appointmentIDFilter = document.getElementById("clientFilter").value.trim().toLowerCase();
  const appointmentDateFilter = document.getElementById("appointmentDateFilter")?.value || "";
  const statusFilter = document.getElementById("statusSort")?.value.toLowerCase() || "";

  const tbody = document.getElementById("appointment-tbody");
  const rows = Array.from(tbody.querySelectorAll("tr"));

  rows.forEach((row) => {
    const appointmentIDCell = row.children[0]?.textContent.trim().toLowerCase(); // Appointment ID
    const appointmentDateCell = row.children[1]?.textContent.trim(); // Appointment Date
    const statusCell = row.children[2]?.textContent.trim().toLowerCase(); // Status

    let showRow = true;

    // Filter by Appointment ID only
    if (appointmentIDFilter && !appointmentIDCell.includes(appointmentIDFilter)) {
      showRow = false;
    }

    // Filter by Appointment Date only
    if (appointmentDateFilter && appointmentDateCell) {
      // Extract only the date part from the cell
      const rowDate = appointmentDateCell.split(" ")[0]; // Takes "2024-11-25" from "2024-11-25 10:00:00"
      
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
    document.getElementById("clientFilter").value = ""
    document.getElementById("appointmentDateFilter").value = ""
    document.getElementById("statusSort").value = ""
  
    filterAndSortAppointments() // Reapply filtering to reset the table
  }