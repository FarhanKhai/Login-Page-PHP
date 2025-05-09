<?php
session_start();
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // buat perilaku ketika salah username atau password
    $query = "SELECT * FROM users where username = '$username'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // buat perilaku ketika username tidak ditemukan


    // buat perilaku ketika password salah


    // buat perilaku ketika login berhasil


    // buat perilaku ketika login gagal


    // buat perilaku ketika login berhasil 


}
?> 