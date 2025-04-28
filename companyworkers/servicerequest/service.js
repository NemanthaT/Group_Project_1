function showRejectPopup() {
    document.getElementById('rejectModal').style.display = 'block';
  }
  
  function closeRejectPopup() {
    document.getElementById('rejectModal').style.display = 'none';
  }
  
  // Close modal if user clicks outside of it
  window.onclick = function(event) {
    const modal = document.getElementById('rejectModal');
    if (event.target == modal) {
      closeRejectPopup();
    }
  }
  
  // Date/time display
  function updateDateTime() {
    const now = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('currentDate').textContent = now.toLocaleDateString('en-US', options);
    document.getElementById('currentTime').textContent = now.toLocaleTimeString('en-US', {
      hour: '2-digit',
      minute: '2-digit'
    });
  }
  document.addEventListener('DOMContentLoaded', function() {
    updateDateTime();
    setInterval(updateDateTime, 60000);
  });