<?php
// Mulai session kalau butuh, tapi di sini gak wajib
// session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Berhasil</title>
    <style>
        body {
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .card {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card h1 {
            color: #28a745;
            margin-bottom: 20px;
        }
        .card p {
            margin-bottom: 30px;
            color: #555;
        }
        .card a {
            text-decoration: none;
            background: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background 0.3s;
        }
        .card a:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Verifikasi Berhasil!</h1>
    <p>Akun kamu sudah diverifikasi. Silakan login sekarang.</p>
    <a href="login.php">Login Sekarang</a>
</div>

</body>
</html>
