<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = 'user';

    // buat perilaku ketika username sudah ada
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Username sudah ada!";
        header("Location: /PraktikumPHP/PHP1/register.php?error=" . urlencode($error));
        exit();
    }

    // buat perilaku ketika password tidak sama
    if ($password !== $confirm_password) {
        $error = "Password mismatched!";
        header("Location: /PraktikumPHP/PHP1/register.php?error=" . urlencode($error));
        exit();
    }

    $hashed_password = md5($password);

    // buat perilaku ketika register berhasil
    $query = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: /PraktikumPHP/PHP1/login.php");
        exit();
    } else {
        // buat perilaku ketika register gagal
        $error = "Registrasi gagal!";
        header("Location: /PraktikumPHP/PHP1/register.php?error=" . urlencode($error));
        exit();
    }
}
?> 