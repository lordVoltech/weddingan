<?php
// Tambahkan header ini di atas file PHP
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Cross-Origin-Opener-Policy: same-origin");

if (isset($_POST['idtoken'])) {
    $idToken = $_POST['idtoken'];

    // Gunakan Google API Client Library untuk memverifikasi ID token
    require_once 'vendor/autoload.php';  // Pastikan kamu sudah install Google Client Library

    $client = new Google_Client(['client_id' => '468756575892-ev53i0f1hfjdg180lo82q2pr545g95ae.apps.googleusercontent.com']);  // Ganti dengan Client ID-mu
    $payload = $client->verifyIdToken($idToken);

    if ($payload) {
        // Token valid
        $userId = $payload['sub'];
        echo "success: User ID: " . $userId;
    } else {
        echo "error: Invalid ID token";
    }
} else {
    echo "No ID token received";
}
?>
