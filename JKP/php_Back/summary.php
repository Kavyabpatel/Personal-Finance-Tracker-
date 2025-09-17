<?php include 'header.php'; 
?>
<style>
    /* General Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 40px;
}

.summary-card {
    background-color: #e3f2fd;
    padding: 20px;
    border-radius: 10px;
    margin: 20px 0;
    text-align: center;
}

.summary-card h2 {
    color: #1976d2;
    font-size: 1.5em;
}

.summary-card p {
    font-size: 1.2em;
    color: #333;
    margin-top: 10px;
}

</style>
<body>
    <div class="container">
        <h1>Monthly Financial Summary</h1>
        <div class="summary-card">
            <h2>Income</h2>
            <p id="income">Loading...</p>
        </div>
        <div class="summary-card">
            <h2>Expense</h2>
            <p id="expense">Loading...</p>
        </div>
        <div class="summary-card">
            <h2>Balance</h2>
            <p id="balance">Loading...</p>
        </div>
    </div>

    <script>
        // Function to fetch summary data
        fetch('fetch_summary_data.php')
            .then(response => response.json())
            .then(data => {
                // Display income, expense, and balance
                document.getElementById('income').innerText = '₹' + data.income;
                document.getElementById('expense').innerText = '₹' + data.expense;
                document.getElementById('balance').innerText = '₹' + data.balance;
            })
            .catch(error => {
                console.error('Error fetching summary data:', error);
            });
    </script>
</body>
</html>
