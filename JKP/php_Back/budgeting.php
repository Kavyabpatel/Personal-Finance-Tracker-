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

.budget-card, .expense-card, .warning-card, .set-budget-card {
    background-color: #e3f2fd;
    padding: 20px;
    border-radius: 10px;
    margin: 20px 0;
    text-align: center;
}

.budget-card h2, .expense-card h2, .warning-card h2, .set-budget-card h2 {
    color: #1976d2;
    font-size: 1.5em;
}

.budget-card p, .expense-card p, .warning-card p, .set-budget-card p {
    font-size: 1.2em;
    color: #333;
    margin-top: 10px;
}

input[type="number"] {
    padding: 10px;
    font-size: 1em;
    margin: 10px 0;
    width: 80%;
    border-radius: 5px;
    border: 1px solid #ccc;
}

button {
    padding: 10px 20px;
    background-color: #1976d2;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1.2em;
    cursor: pointer;
}

button:hover {
    background-color: #1565c0;
}

#status-message {
    color: #d32f2f;
    margin-top: 10px;
}

</style>
<body>
    <div class="container">
        <h1>Monthly Budget</h1>

        <div class="budget-card">
            <h2>Current Budget</h2>
            <p id="budget">Loading...</p>
        </div>

        <div class="expense-card">
            <h2>Total Expenses</h2>
            <p id="total_expense">Loading...</p>
        </div>

        <div class="warning-card" id="warning" style="display: none;">
            <h2>Warning</h2>
            <p id="warning-message"></p>
        </div>

        <div class="set-budget-card">
            <h2>Set New Budget</h2>
            <input type="number" id="new-budget" placeholder="Enter new budget amount" />
            <button id="set-budget-button">Set Budget</button>
            <p id="status-message"></p>
        </div>
    </div>

    <script>
document.getElementById('set-budget-button').addEventListener('click', function () {
    const newBudget = document.getElementById('new-budget').value;

    if (!newBudget || newBudget <= 0) {
        document.getElementById('status-message').innerText = 'Please enter a valid budget amount.';
        return;
    }

    // Send the new budget to the backend
    fetch('set_budget.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ budget: newBudget }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('status-message').innerText = 'Budget set successfully!';
            fetchBudget();  // Re-fetch the budget after setting it
        } else {
            document.getElementById('status-message').innerText = 'Error: ' + data.message;
        }
    })
    .catch(error => {
        console.error('Error setting new budget:', error);
    });
});

function fetchBudget() {
    fetch('fetch_budget.php')
        .then(response => response.json())
        .then(data => {
            console.log("API Response:", data);  // Debugging

            // Update budget
            if (data.budget !== undefined) {
                document.getElementById('budget').innerText = `₹${data.budget}`;
            }

            // Fix: Correct ID for total expense
            if (data.total_expense !== undefined) {
                document.getElementById('total_expense').innerText = `₹${data.total_expense}`;
            }

            // Fix: Update warning message inside <p id="warning-message">
            if (data.warning) {
                document.getElementById('warning-message').innerText = data.warning;
                document.getElementById('warning').style.display = 'block';  // Show warning
            } else {
                document.getElementById('warning').style.display = 'none';  // Hide warning
            }
        })
        .catch(error => {
            console.error('Error fetching budget and expenses:', error);
        });
}

// Fetch budget on page load
window.onload = fetchBudget;
</script>

</body>
</html>
