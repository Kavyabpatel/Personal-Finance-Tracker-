<?php
include '../db_settings/config.php';

$incomeQuery = "SELECT SUM(amount) AS total_income FROM transactions WHERE type='income'";
$expenseQuery = "SELECT SUM(amount) AS total_expense FROM transactions WHERE type='expense'";

$incomeResult = mysqli_query($conn, $incomeQuery);
$expenseResult = mysqli_query($conn, $expenseQuery);

$income = mysqli_fetch_assoc($incomeResult)['total_income'] ?? 0;
$expense = mysqli_fetch_assoc($expenseResult)['total_expense'] ?? 0;

echo json_encode(["income" => $income, "expense" => $expense]);
?>
