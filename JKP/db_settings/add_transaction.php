
<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $type = $_POST['type']; // Income or Expense
    $category = $_POST['category']; // Movie, Food, etc.
    
    // Get the next serial number
    $result = $conn->query("SELECT MAX(serial_number) AS max_serial FROM transactions");
    $row = $result->fetch_assoc();
    $new_serial = ($row['max_serial'] ?? 0) + 1;

    // Insert transaction with dynamic serial_number
    $sql = "INSERT INTO transactions (amount, type, category, serial_number) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $amount, $type, $category, $new_serial);

    if ($stmt->execute()) {
        header("Location: ../php_Back/transction.php");
        exit();
    } else {
        header("Location: ../php_Back/transction.php");
        exit();
    }
}
?>
