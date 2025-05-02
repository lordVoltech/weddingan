<?php
// Start the session
session_start();

require 'config.php';

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
    $_SESSION['old_email'] = $email;

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        if ($user['is_verified'] == 1) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_email'] = $email;
            header('Location: dashboard.php');
            exit;
        } else {
            $_SESSION['error_message'] = 'Please verify your email first.';
            header('Location: login.php');
            exit;
        }
    } else {
        $_SESSION['error_message'] = 'Invalid email or password.';
        header('Location: login.php');
        exit;
    }
}
?>
