<?php
session_start();
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location.href='trydash.html';</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION["user"] = $full_name;
        echo "<script>alert('You are registered successfully!'); window.location.href='../index.html';</script>";
        exit();
    } else {
        echo "<script>alert('Error: Could not register. Try again!'); window.history.back();</script>";
    }
}
?>
