<?php
// Start the session
session_start();

require_once 'config.php'; // atau db.php sesuai nama file kamu

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
            header('Location: index.php');        
        }
    } else {
        $_SESSION['error_message'] = 'Email atau Pw salah rek.';
        header('Location: index.php');    }
}
?>

<!-- <script>
  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var id_token = googleUser.getAuthResponse().id_token;

    // Kirim ID token ke server untuk validasi
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'validate_token.php');  // Misalnya file untuk validasi token
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      console.log('Signed in as: ' + xhr.responseText);
    };
    xhr.send('idtoken=' + id_token);  // Kirim token ke server
  }
</script> -->
