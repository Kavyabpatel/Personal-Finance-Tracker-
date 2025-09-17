<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Fetch user from database
    $stmt = $conn->prepare("SELECT id, full_name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $full_name, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $full_name;

            // Redirect to dashboard
            header("Location: ../php_Back/index.php");
            exit();
        } else {
            echo "<script>alert('Invalid Password!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found! Please sign up.'); window.history.back();</script>";
    }
} else {
    echo "Form not submitted!";
}
?>
