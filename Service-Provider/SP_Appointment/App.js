function filterAppointments() {
    const filterValue = document.getElementById("clientFilter").value.toLowerCase();
    const rows = document.querySelectorAll("#appointment-tbody tr");

    rows.forEach(row => {
        const clientID = row.querySelector(".client-id").textContent.toLowerCase();
        const appointmentID = row.querySelector(".appointment-id").textContent.toLowerCase();

        // Check if either the clientID or appointmentID includes the filterValue
        if (clientID.includes(filterValue) || appointmentID.includes(filterValue)) {
            row.style.display = ""; // Show row
        } else {
            row.style.display = "none"; // Hide row
        }
    });
}
