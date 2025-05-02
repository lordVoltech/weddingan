<?php
// Database connection
$host = 'localhost'; // Your database host
$db = 'u951570841_weddingan'; // Your database name
$user = 'u951570841_rois'; // Your database username
$pass = 'R01s4nw4r'; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
