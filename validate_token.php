<head>
<meta http-equiv="Cross-Origin-Opener-Policy" content="same-origin">
<meta http-equiv="Cross-Origin-Embedder-Policy" content="require-corp">
</head>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_token = $_POST['id_token'];

    $CLIENT_ID = 'YOUR_CLIENT_ID'; // dari Google Cloud Console

    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=$id_token";
    $data = json_decode(file_get_contents($url), true);

    if ($data && isset($data['aud']) && $data['aud'] == $CLIENT_ID) {
        session_start();
        $_SESSION['user_email'] = $data['email'];
        $_SESSION['user_name'] = $data['name'];
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
