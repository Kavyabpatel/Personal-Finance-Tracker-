<?php include 'header.php'; ?>
<style>
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

    .goal-card, .progress-card, .set-goal-card {
        background-color: #e3f2fd;
        padding: 20px;
        border-radius: 10px;
        margin: 20px 0;
        text-align: center;
    }

    h2 {
        color: #1976d2;
        font-size: 1.5em;
    }

    p {
        font-size: 1.2em;
        color: #333;
        margin-top: 10px;
    }

    .progress-bar-container {
        background-color: #ddd;
        border-radius: 20px;
        padding: 5px;
        margin-top: 10px;
    }

    .progress-bar {
        height: 20px;
        background-color: #4caf50;
        border-radius: 15px;
        text-align: center;
        color: white;
        font-weight: bold;
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
        <h1>Savings Goal Tracker</h1>

        <div class="goal-card">
            <h2>Current Savings Goal</h2>
            <p id="goal-amount">Loading...</p>
            <p id="goal-duration">Loading...</p>
        </div>

        <div class="progress-card">
            <h2>Total Savings</h2>
            <p id="total-savings">Loading...</p>
            <div class="progress-bar-container">
                <div id="progress-bar" class="progress-bar" style="width: 0%;">0%</div>
            </div>
        </div>

        <div class="set-goal-card">
            <h2>Set New Savings Goal</h2>
            <input type="number" id="goal-amount-input" placeholder="Enter goal amount" />
            <input type="number" id="goal-duration-input" placeholder="Enter duration (months)" />
            <button id="set-goal-button">Set Goal</button>
            <p id="status-message"></p>
        </div>
    </div>

    <script>
        function fetchSavingsGoal() {
            fetch('fetch_savings_goal.php')
                .then(response => response.json())
                .then(data => {
                    console.log("API Response:", data);

                    document.getElementById('goal-amount').innerText = `Goal: ₹${data.goal_amount}`;
                    document.getElementById('goal-duration').innerText = `Duration: ${data.goal_duration} months`;
                    document.getElementById('total-savings').innerText = `Total Savings: ₹${data.total_savings}`;

                    let progress = Math.min(data.progress, 100); // Ensure it doesn't exceed 100%
                    document.getElementById('progress-bar').style.width = `${progress}%`;
                    document.getElementById('progress-bar').innerText = `${progress.toFixed(2)}%`;
                })
                .catch(error => console.error('Error fetching savings goal:', error));
        }

        document.getElementById('set-goal-button').addEventListener('click', function () {
            const goal = document.getElementById('goal-amount-input').value;
            const months = document.getElementById('goal-duration-input').value;
            const user_id = 1; // Update dynamically if needed

            if (!goal || !months || goal <= 0 || months <= 0) {
                document.getElementById('status-message').innerText = 'Please enter valid goal and duration.';
                return;
            }

            fetch('set_savings_goal.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ goal, months, user_id }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('status-message').innerText = 'Savings goal set successfully!';
                    fetchSavingsGoal();
                } else {
                    document.getElementById('status-message').innerText = 'Error: ' + data.message;
                }
            })
            .catch(error => {
                console.error('Error setting savings goal:', error);
            });
        });

        // Fetch savings goal on page load
        window.onload = fetchSavingsGoal;
    </script>
</body>
</html>
