document.querySelector('.new-message').addEventListener('click', function() {
    const tableBody = document.getElementById('message-tbody');
    const newRow = document.createElement('tr');

    // Sample data for new message row
    newRow.innerHTML = `
        <td>Sample Topic</td>
        <td>Consultation Service</td>
        <td>Pending</td>
    `;

    tableBody.appendChild(newRow);
});
