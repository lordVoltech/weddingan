<?php
session_start();
require_once 'config.php'; // koneksi ke DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_token = $_POST['id_token'];
    $client_id = '468756575892-ev53i0f1hfjdg180lo82q2pr545g95ae.apps.googleusercontent.com';

    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=$id_token";
    $data = json_decode(file_get_contents($url), true);

    if ($data && isset($data['aud']) && $data['aud'] == $client_id) {
        $email = $data['email'];
        $name = $data['name'];
        $google_id = $data['sub'];

        // 🌟 Cek apakah user sudah ada
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            // 🔐 Masukkan user baru
            $stmt = $pdo->prepare("INSERT INTO users (email, password_hash, created_at, is_verified, verify_token) VALUES (?, ?, NOW(), 1, NULL)");
            $fakePassword = password_hash($google_id, PASSWORD_DEFAULT); // hash ID Google sebagai dummy password
            $stmt->execute([$email, $fakePassword]);

            // Ambil ulang user yang baru saja dibuat
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
        }

        // 🛡️ Simpan session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $name;
        $_SESSION['user_role'] = 'google_user'; // default role

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
