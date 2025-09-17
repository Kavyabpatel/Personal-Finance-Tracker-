<?php
include '../db_settings/db2.php'; // Database connection

$current_month = date('m');
$current_year = date('Y');

// Fetch monthly income & expenses
$income_query = "SELECT SUM(amount) AS total_income FROM transactions WHERE type='income' AND MONTH(created_at)=$current_month AND YEAR(created_at)=$current_year";
$expense_query = "SELECT SUM(amount) AS total_expense FROM transactions WHERE type='expense' AND MONTH(created_at)=$current_month AND YEAR(created_at)=$current_year";

$income_result = mysqli_fetch_assoc(mysqli_query($conn, $income_query));
$expense_result = mysqli_fetch_assoc(mysqli_query($conn, $expense_query));

$response = [
    'income' => $income_result['total_income'] ?: 0,
    'expense' => $expense_result['total_expense'] ?: 0,
    'balance' => ($income_result['total_income'] ?: 0) - ($expense_result['total_expense'] ?: 0)
];

echo json_encode($response);
?>
