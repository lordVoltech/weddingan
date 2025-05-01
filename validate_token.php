<?php
session_start();
require_once 'config.php'; // koneksi PDO di sini

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_token = $_POST['id_token'];
    $client_id = '468756575892-ev53i0f1hfjdg180lo82q2pr545g95ae.apps.googleusercontent.com';

    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=$id_token";
    $data = json_decode(file_get_contents($url), true);

    if ($data && isset($data['aud']) && $data['aud'] == $client_id) {
        $email = $data['email'];
        $name  = $data['name'];

        // Cek apakah user sudah ada di database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            // Belum ada, buat user baru
            $stmt = $pdo->prepare("INSERT INTO users (id, email, password_hash, created_at, is_verified, verify_token) VALUES (?, NULL, NOW(), 1, NULL)");
            $stmt->execute([$email]);
            $user_id = $pdo->lastInsertId();
        } else {
            $user_id = $user['id'];
        }

        // Simpan ke session
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_role'] = 'google_user';

        echo json_encode([
            "success" => true,
            "name" => $name,
            "email" => $email
        ]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
