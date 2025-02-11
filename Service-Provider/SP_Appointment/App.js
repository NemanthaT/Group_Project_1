function filterAppointments() {
    const filterValue = document.getElementById("clientFilter").value.trim().toLowerCase();
    const rows = document.querySelectorAll("#appointment-tbody tr");

    rows.forEach(row => {
        // Check both Appointment ID (first column) and Client ID (second column)
        const appointmentIDCell = row.children[0]?.textContent.toLowerCase();
        const clientIDCell = row.children[1]?.textContent.toLowerCase();

        // Show row if either matches the search input
        if (
            (appointmentIDCell && appointmentIDCell.includes(filterValue)) ||
            (clientIDCell && clientIDCell.includes(filterValue))
        ) {
            row.style.display = ""; // Show row
        } else {
            row.style.display = "none"; // Hide row
        }
    });
}
