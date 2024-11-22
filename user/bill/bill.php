<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bills Dashboard</h1>
    </header>
    <div class="container">
        <!-- Filter and Search Section -->
        <div class="controls">
            <div class="filter-group">
                <select id="status-filter">
                    <option value="all">All Bills</option>
                    <option value="paid">Paid</option>
                    <option value="unpaid">Unpaid</option>
                </select>
            </div>
            <div class="search-group">
                <input type="text" placeholder="Search client ID or service..." id="search">
                <button class="search-button">search </button>
            </div>
        </div>

        <!-- Bills Grid -->
        <div class="bills-grid">
            <!-- Bill Card 1 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY001</span>
                    <span class="status unpaid">Unpaid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT100</p>
                        <p><strong>Service:</strong> Plumbing</p>
                        <p><strong>Amount:</strong> $250.00</p>
                        <p><strong>Date:</strong> 2024-11-20</p>
                        <p><strong>Service ID:</strong> SRV501</p>
                    </div>
                    <button class="pay-button">Pay Bill</button>
                </div>
            </div>

            <!-- Bill Card 2 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY002</span>
                    <span class="status paid">Paid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT101</p>
                        <p><strong>Service:</strong> Electrical</p>
                        <p><strong>Amount:</strong> $180.50</p>
                        <p><strong>Date:</strong> 2024-11-21</p>
                        <p><strong>Service ID:</strong> SRV502</p>
                    </div>
                    <button class="pay-button" disabled>Paid</button>
                </div>
            </div>

            <!-- Bill Card 3 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY003</span>
                    <span class="status unpaid">Unpaid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT102</p>
                        <p><strong>Service:</strong> Cleaning</p>
                        <p><strong>Amount:</strong> $320.75</p>
                        <p><strong>Date:</strong> 2024-11-22</p>
                        <p><strong>Service ID:</strong> SRV503</p>
                    </div>
                    <button class="pay-button">Pay Bill</button>
                </div>
            </div>

            <!-- Bill Card 4 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY004</span>
                    <span class="status unpaid">Unpaid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT103</p>
                        <p><strong>Service:</strong> Gardening</p>
                        <p><strong>Amount:</strong> $150.00</p>
                        <p><strong>Date:</strong> 2024-11-23</p>
                        <p><strong>Service ID:</strong> SRV504</p>
                    </div>
                    <button class="pay-button">Pay Bill</button>
                </div>
            </div>

            <!-- Bill Card 5 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY005</span>
                    <span class="status paid">Paid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT104</p>
                        <p><strong>Service:</strong> Painting</p>
                        <p><strong>Amount:</strong> $420.25</p>
                        <p><strong>Date:</strong> 2024-11-24</p>
                        <p><strong>Service ID:</strong> SRV505</p>
                    </div>
                    <button class="pay-button" disabled>Paid</button>
                </div>
            </div>

            <!-- Bill Card 6 -->
            <div class="bill-card">
                <div class="bill-header">
                    <span class="payment-id">PAY006</span>
                    <span class="status unpaid">Unpaid</span>
                </div>
                <div class="bill-content">
                    <div class="bill-info">
                        <p><strong>Client ID:</strong> CLT105</p>
                        <p><strong>Service:</strong> Carpentry</p>
                        <p><strong>Amount:</strong> $280.00</p>
                        <p><strong>Date:</strong> 2024-11-25</p>
                        <p><strong>Service ID:</strong> SRV506</p>
                    </div>
                    <button class="pay-button">Pay Bill</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>