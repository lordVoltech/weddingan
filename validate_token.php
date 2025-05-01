
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_token = $_POST['id_token'];

    $CLIENT_ID = '468756575892-ev53i0f1hfjdg180lo82q2pr545g95ae.apps.googleusercontent.com'; // dari Google Cloud Console

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
