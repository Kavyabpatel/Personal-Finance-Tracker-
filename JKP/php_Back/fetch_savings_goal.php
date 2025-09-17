<?php
include '../db_settings/db2.php';

$user_id = 1; // Change this dynamically if needed

// Fetch savings goal for the user
$goal_query = "SELECT amount, months FROM savings_goals WHERE user_id = $user_id ORDER BY created_at DESC LIMIT 1";
$goal_result = mysqli_fetch_assoc(mysqli_query($conn, $goal_query));

$goal_amount = $goal_result['amount'] ?? 0;
$goal_duration = $goal_result['months'] ?? 0;

// Fetch total savings (income - expenses)
$income_query = "SELECT SUM(amount) AS total_income FROM transactions WHERE type='income'";
$expense_query = "SELECT SUM(amount) AS total_expense FROM transactions WHERE type='expense'";

$income_result = mysqli_fetch_assoc(mysqli_query($conn, $income_query));
$expense_result = mysqli_fetch_assoc(mysqli_query($conn, $expense_query));

$total_savings = ($income_result['total_income'] ?: 0) - ($expense_result['total_expense'] ?: 0);
$progress = ($goal_amount > 0) ? ($total_savings / $goal_amount) * 100 : 0;

$response = [
    'goal_amount' => $goal_amount,
    'goal_duration' => $goal_duration,
    'total_savings' => $total_savings,
    'progress' => round($progress, 2)
];

echo json_encode($response);
?>
