<?php
session_start();

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    // Buat notif di session
    $_SESSION['error_message'] = 'Anda perlu login terlebih dahulu.';
    header('Location: index.php');
    exit;
}

// Periksa apakah sesi login sudah ada
if (!isset($_SESSION['google_id'])) {
    // Jika belum login, arahkan ke halaman login
    header('Location: login.php');
    exit();
}

// Tampilkan informasi pengguna yang sudah login
echo 'Selamat datang, ' . $_SESSION['google_name'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>INI DASHBOARD NIH</h1>
    <p>Selamat datang user ID: <?php echo $_SESSION['user_id']; ?> 🥰</p>

    <a href="logout.php">Logout</a>
</body>
</html>
