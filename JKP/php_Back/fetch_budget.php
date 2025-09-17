<?php
include '../db_settings/db2.php';

$month = date('m');
$year = date('Y');

// Fetch budget for the current month and year
$budget_query = "SELECT amount FROM budget WHERE month=$month AND year=$year";
$budget_result = mysqli_fetch_assoc(mysqli_query($conn, $budget_query));
$budget = $budget_result['amount'] ?? 0;  // Default to 0 if no budget found

// Fetch total expenses for the current month and year
$expense_query = "SELECT COALESCE(SUM(amount), 0) AS total_expense FROM transactions WHERE type='expense' AND MONTH(created_at)=$month AND YEAR(created_at)=$year";
$expense_result = mysqli_fetch_assoc(mysqli_query($conn, $expense_query));
$total_expense = $expense_result['total_expense'];  // Default to 0 if no expenses found

// Debugging (Log errors in case of issues)
if (!$expense_result) {
    error_log("Expense Query Error: " . mysqli_error($conn));
}


// Prepare response
$response = [
    'budget' => $budget,
    'total_expense' => $total_expense,
    'warning' => ($budget > 0 && $total_expense > $budget) ? "Warning: You have exceeded your monthly budget!" : ""
];

echo json_encode($response);
?>
