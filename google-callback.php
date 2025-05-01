<?php
require 'vendor/autoload.php'; // Kalau pakai composer

$client = new Google_Client();
$client->setClientId('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D');
$client->setClientSecret('468756575892-ev53i0f1hfjdg180lo82q2pr545g95ae.apps.googleusercontent.com');
$client->setRedirectUri('https://mediumslateblue-snail-933847.hostingersite.com/google-callback.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $oauth = new Google_Service_Oauth2($client);
    $userinfo = $oauth->userinfo->get();

    // Contoh ambil data
    $email = $userinfo->email;
    $name = $userinfo->name;

    // Simpan ke session dan redirect ke dashboard
    session_start();
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $name;
    header('Location: dashboard.php');
    exit;
} else {
    echo "Login gagal.";
}
?>
