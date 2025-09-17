<?php include 'header.php'; ?>
<?php include '../db_settings/config.php'; ?>

<main>
<head>
    <link rel="stylesheet" href="style.css"> <!-- Only for transaction.php -->
</head>
    <h2>Manage Transactions</h2>

    <!-- Transaction Form -->
    <form action="/JKP/db_settings/add_transaction.php" method="POST">
        <label for="type">Type:</label>
        <select name="type" required>
            <option value="income">Income</option>
            <option value="expense">Expense</option>
        </select>

        <label for="category">Category:</label>
        <select name="category" required>
            <option value="Salary">Salary</option>
            <option value="Movie">Movie</option>
            <option value="Food">Food</option>
            <option value="Shopping">Shopping</option>
            <option value="Transport">Transport</option>
            <option value="Other">Other</option>
        </select>

        <label for="amount">Amount:</label>
        <input type="number" name="amount" required>

        <button type="submit">Add Transaction</button>
    </form>

    <h3>Transaction History</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>

        <?php
        $sql = "SELECT * FROM transactions ORDER BY id DESC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['type']}</td>
                    <td>{$row['category']}</td>
                    <td>{$row['amount']}</td>
                    <td>
                        <form action='../db_settings/delete_transaction.php' method='POST'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' class='delete-btn'>Delete</button>
                        </form> 
                    </td>
                </tr>";
        }
        ?>
    </table>
</main>


