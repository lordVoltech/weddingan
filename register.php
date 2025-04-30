<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php



// Start the session
session_start();

require_once 'config.php'; // atau db.php sesuai nama file kamu


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat_password'];

    if ($password !== $repeatPassword) {
        $_SESSION['error_message'] = 'Password tidak cocok!';
        $_SESSION['old_email'] = $email;
        header('Location: register-tampil.php');
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare('INSERT INTO users (email, password_hash) VALUES (?, ?)');
    $stmt->execute([$email, $hashedPassword]);

    // Ambil ID user yang baru
    $userId = $pdo->lastInsertId();

    // Generate token verifikasi (bisa pakai random)
    $verificationToken = bin2hex(random_bytes(16));

    // Simpan token verifikasi di database (kolom tambahan 'verification_token' harus ada)
    $stmt = $pdo->prepare('UPDATE users SET verification_token = ? WHERE id = ?');
    $stmt->execute([$verificationToken, $userId]);

    // Kirim email verifikasi
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // gunakan SMTP sesuai kebutuhan
        $mail->SMTPAuth = true;
        $mail->Username = 'syamilalghani.9i@gmail.com'; // Email kamu
        $mail->Password = 'amfv nmui rrna gpbe';  // Password email kamu
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;


        //Recipients
        $mail->setFrom('syamilalghani.9i@gmail.com', 'JOKO KONTOL');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = 'Klik <a href="https://mediumslateblue-snail-933847.hostingersite.com/verify.php?token=' . $verificationToken . '">di sini</a> untuk verifikasi email Anda.';

        $mail->send();
        $_SESSION['success_message'] = 'Email verification sent! Silakan cek email kamu.';
        header('Location: index.php');
    } catch (Exception $e) {
        $_SESSION['success_message'] = 'Message could not be sent. Mailer Error: {$mail->ErrorInfo}';
        header('Location: index.php');
    }
}
?>
