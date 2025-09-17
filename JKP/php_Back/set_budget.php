<?php
include '../db_settings/db2.php'; // Ensure correct DB connection file

header("Content-Type: application/json"); // Set response as JSON

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Check if budget key exists
if (!isset($data['budget'])) {
    echo json_encode(["status" => "error", "message" => "Budget not provided"]);
    exit;
}

$budget = $data['budget']; // Get budget value
$month = date('m');  // Get current month
$year = date('Y');   // Get current year

// Ensure it's a valid number
if (!is_numeric($budget) || $budget <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid budget value"]);
    exit;
}

// Insert or update budget for the current month and year
$sql = "INSERT INTO budget (month, year, amount) 
        VALUES (?, ?, ?) 
        ON DUPLICATE KEY UPDATE amount = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iidi", $month, $year, $budget, $budget); // Bind parameters

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Budget set successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Database error"]);
}

$stmt->close();
$conn->close();
?>
