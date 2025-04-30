<?php
// Start the session
session_start();

// Database connection
$host = 'localhost'; // Your database host
$db = 'u951570841_weddingan'; // Your database name
$user = 'u951570841_rois'; // Your database username
$pass = 'R01s4nw4r'; // Your database password


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
