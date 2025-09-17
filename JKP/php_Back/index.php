<?php include 'header.php'; 
include '../db_settings/db2.php';?>
<main style="max-width: 1200px; margin: auto;">

    <!-- Page Title -->
    <div style="text-align: center; margin-bottom: 20px;">
        <h2>📊 Financial Dashboard</h2>
    </div>

    <!-- Summary Cards -->
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <div class="summary-card" id="incomeCard">💰 Income: ₹0</div>
        <div class="summary-card" id="expenseCard">💸 Expense: ₹0</div>
        <div class="summary-card" id="balanceCard">📈 Balance: ₹0</div>
    </div>

    <!-- Divider Line -->
    <hr style="margin: 20px 0; border-top: 2px solid #ccc;">

    <!-- Chart Section -->
    <div style="display: flex; justify-content: center; align-items: center; gap: 20px; flex-wrap: wrap;">

        <!-- Income vs Expense Chart -->
        <div style="width: 45%; max-width: 500px;">
            <h3 style="text-align: center;">📉 Income vs Expense</h3>
            <div style="height: 300px;">
                <canvas id="incomeExpenseChart"></canvas>
            </div>
        </div>

        <!-- Expense Categories Pie Chart -->
        <div style="width: 45%; max-width: 400px;">
            <h3 style="text-align: center;">🍕 Expense Breakdown</h3>
            <div style="height: 300px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Fetch Summary Data -->
    <script>
        fetch('fetch_summary_data.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('incomeCard').innerHTML = `💰 Income: ₹${data.income}`;
                document.getElementById('expenseCard').innerHTML = `💸 Expense: ₹${data.expense}`;
                document.getElementById('balanceCard').innerHTML = `📈 Balance: ₹${data.balance}`;
            });
    </script>

    <!-- Income vs Expense Chart -->
    <script>
        fetch('fetch_chart_data.php')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('incomeExpenseChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Income', 'Expense'],
                        datasets: [{
                            label: 'Amount',
                            data: [data.income, data.expense],
                            backgroundColor: ['#28a745', '#dc3545']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>

    <!-- Expense Categories Pie Chart -->
    <script>
        fetch('fetch_category_data.php')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('categoryChart').getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: data.categories,
                        datasets: [{
                            data: data.amounts,
                            backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            });
    </script>

            

</main>

