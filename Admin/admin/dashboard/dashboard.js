// Users Chart
// Fetch the data from the server

const usersCtx = document.getElementById('usersChart').getContext('2d');
console.log(chartData);
const labels = ["Clients", "Service Providers", "Employees"];
const data = [chartData.clients, chartData.serviceProviders, chartData.employees];
clients = parseInt(chartData.clients, 10);
serviceProviders = parseInt(chartData.serviceProviders, 10);
employees = parseInt(chartData.employees ,10);
const total = clients + serviceProviders + employees;
console.log("total- " + total);

new Chart(usersCtx, {
    type: 'doughnut',
    data: {
        labels: ["Clients", "Service Providers", "Employees"],
        datasets: [{
            data: [chartData.clients, chartData.serviceProviders, chartData.employees],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
            borderWidth: 1
        }]
    },
    options: {
        maintainAspectRatio: false,
        cutout: '70%',
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    boxWidth: 12,
                    padding: 15,
                    font: {
                        size: 11
                    }
                }
            },
            tooltip: {
                backgroundColor: "rgb(255,255,255)",
                bodyColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function(context) {
                        var label = context.label || '';
                        var value = context.parsed || 0;
                        var percentage = Math.round((value / total) * 100);
                        return `${label}: ${value} (${percentage}%)`;
                    }
                }
            }
        }
    }
});