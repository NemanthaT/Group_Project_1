document.querySelector('.new-appointment').addEventListener('click', function() {
    const tableBody = document.getElementById('appointment-tbody');
    const newRow = document.createElement('tr');

    // Sample data for new appointment row
    newRow.innerHTML = `
        <td>AP123</td>
        <td>Consultation</td>
        <td>2024-11-05</td>
        <td>Pending</td>
    `;

    tableBody.appendChild(newRow);
});
