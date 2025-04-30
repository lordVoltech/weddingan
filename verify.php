<?php
session_start();

require_once 'config.php'; // atau db.php sesuai nama file kamu

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Cek token dari URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Cek token di database
    $stmt = $pdo->prepare('SELECT * FROM users WHERE verification_token = ?');
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        // Verifikasi email dan update status
        $stmt = $pdo->prepare('UPDATE users SET is_verified = 1, verification_token = NULL WHERE id = ?');
        $stmt->execute([$user['id']]);

        // Setelah sukses verifikasi
        header('Location: verification_success.php');
        exit;
    } else {
        echo 'Invalid or expired token.';
    }
} else {
    echo 'No token provided.';
}
?>
