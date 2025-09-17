
<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Delete the transaction
    $sql = "DELETE FROM transactions WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Reset serial_number after deletion
        $conn->query("SET @new_serial = 0;");
        $conn->query("UPDATE transactions SET serial_number = (@new_serial := @new_serial + 1) ORDER BY id;");

        // Reset AUTO_INCREMENT if table is empty
        $result = $conn->query("SELECT COUNT(*) AS total FROM transactions");
        $row = $result->fetch_assoc();
        if ($row['total'] == 0) {
            $conn->query("ALTER TABLE transactions AUTO_INCREMENT = 1");
        }

        header("Location: ../php_Back/transction.php");
        exit();
    } else {
        header("Location: ../php_Back/transction.php");
        exit();
    }
}
?>

