function filterAndSortAppointments() {
    const searchValue = document.getElementById("clientFilter").value.trim().toLowerCase();
    const appointmentDateFilter = document.getElementById("appointmentDateFilter") ? document.getElementById("appointmentDateFilter").value : ""; // Corrected ID
    const statusSortValue = document.getElementById("statusSort") ? document.getElementById("statusSort").value.toLowerCase() : "";

    const tbody = document.getElementById("appointment-tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    rows.forEach(row => {
        const appointmentIDCell = row.children[0]?.textContent.trim().toLowerCase();
        const clientIDCell = row.children[1]?.textContent.trim().toLowerCase();
        const appointmentDateCell = row.children[2]?.textContent.trim(); 
        const statusCell = row.children[3]?.textContent.trim().toLowerCase();

        let showRow = true;

        // 🔹 Filter by Appointment ID or Client ID
        if (searchValue && !(appointmentIDCell.includes(searchValue) || clientIDCell.includes(searchValue))) {
            showRow = false;
        }

        // 🔹 Filter by Appointment Date
        if (appointmentDateFilter && appointmentDateCell) {
            const rowDate = new Date(appointmentDateCell).toISOString().split("T")[0]; // Convert row date to YYYY-MM-DD
            if (rowDate !== appointmentDateFilter) {
                showRow = false;
            }
        }

        // 🔹 Filter by Status
        if (statusSortValue && statusCell !== statusSortValue) {
            showRow = false;
        }

        row.style.display = showRow ? "" : "none";
    });

    // 🔹 Sort by Status (if applicable)
    if (statusSortValue) {
        rows.sort((a, b) => {
            const statusA = a.children[3]?.textContent.trim().toLowerCase();
            const statusB = b.children[3]?.textContent.trim().toLowerCase();
            return statusA.localeCompare(statusB);
        });

        // Re-append sorted rows
        tbody.innerHTML = "";
        rows.forEach(row => tbody.appendChild(row));
    }
}

function clearFilters() {
    document.getElementById("clientFilter").value = "";
    document.getElementById("appointmentDateFilter").value = "";
    document.getElementById("statusSort").value = "";

    filterAndSortAppointments(); // Reapply filtering to reset the table
}