<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_token = $_POST['id_token'];
    $client_id = '468756575892-ev53i0f1hfjdg180lo82q2pr545g95ae.apps.googleusercontent.com'; // dari Google Cloud Console

    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=$id_token";
    $data = json_decode(file_get_contents($url), true);

    if ($data && isset($data['aud']) && $data['aud'] == $client_id) {
        // ✅ Simpan session sesuai sistem login kamu
        $_SESSION['user_id'] = $data['sub']; // ID unik dari Google
        $_SESSION['user_name'] = $data['name'];
        $_SESSION['user_email'] = $data['email'];
        $_SESSION['user_picture'] = $data['picture']; // opsional

        echo json_encode([
            "success" => true,
            "name" => $data['name'],
            "email" => $data['email']
        ]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
