<?php
session_start();

// Cek apakah user sudah login atau belum
if (!isset($_SESSION['user_id'])) {
    // Buat notif di session
    $_SESSION['error_message'] = 'Anda perlu login terlebih dahulu.';
    header('Location: login.php');
    exit;
}

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
    <h1>Halo, <?php echo $_SESSION['user_name']; ?>!</h1>
    <p>Email: <?php echo $_SESSION['user_email']; ?></p>
    <img src="<?php echo $_SESSION['user_picture']; ?>" width="100">

    <a href="logout.php">Logout</a>
</body>
</html>
