<?php
include '../db_settings/database.php';

$query = "SELECT MONTHNAME(date) AS month, 
                 SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END) AS total_income,
                 SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END) AS total_expense
          FROM transactions
          GROUP BY MONTH(date)
          ORDER BY MONTH(date)";

$result = mysqli_query($conn, $query);

$data = ["months" => [], "income" => [], "expense" => []];

while ($row = mysqli_fetch_assoc($result)) {
    $data["months"][] = $row["month"];
    $data["income"][] = (float)$row["total_income"];
    $data["expense"][] = (float)$row["total_expense"];
}

echo json_encode($data);
?>
