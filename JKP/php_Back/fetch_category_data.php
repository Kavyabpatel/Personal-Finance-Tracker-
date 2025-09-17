<?php
include '../db_settings/config.php';

$query = "SELECT category, SUM(amount) AS total FROM transactions WHERE type='expense' GROUP BY category";
$result = mysqli_query($conn, $query);

$categories = [];
$amounts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row['category'];
    $amounts[] = $row['total'];
}

echo json_encode(["categories" => $categories, "amounts" => $amounts]);
?>
