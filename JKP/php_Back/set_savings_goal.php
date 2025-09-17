<?php
header("Content-Type: application/json");
include "../db_settings/db2.php";  // Ensure this contains $conn

// Read POST data (supports JSON and x-www-form-urlencoded)
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    $data = $_POST;
}

// Debugging: Check received data
if (empty($data)) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit();
}

// Validate required fields
if (!isset($data['goal']) || !isset($data['months']) || !isset($data['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Goal, duration, or user ID not provided"]);
    exit();
}

$goal = $data['goal'];
$months = $data['months'];
$user_id = $data['user_id'];

// Ensure valid numeric input
if (!is_numeric($goal) || !is_numeric($months)) {
    echo json_encode(["status" => "error", "message" => "Invalid goal or duration"]);
    exit();
}

// SQL Query to insert/update savings goal
$query = "INSERT INTO savings_goals (user_id, amount, months)
          VALUES (?, ?, ?)
          ON DUPLICATE KEY UPDATE amount = VALUES(amount), months = VALUES(months)";

$stmt = $conn->prepare($query);
$stmt->bind_param("idd", $user_id, $goal, $months);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Savings goal set successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to set savings goal"]);
}

$stmt->close();
$conn->close();
?>
