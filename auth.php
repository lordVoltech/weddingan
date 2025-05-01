<?php
// Start the session
session_start();

require 'config.php'; // atau include 'config.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simpan email lama ke session biar gak ilang
    $_SESSION['old_email'] = $email;

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        if ($user['is_verified'] == 1) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: dashboard.php');
            exit;
        } else {
            $_SESSION['error_message'] = 'verivikasi dulu mas.';
            header('Location: login.php');        
        }
    } else {
        $_SESSION['error_message'] = 'Email atau Pw salah rek.';
        header('Location: login.php');    }
}
?>
