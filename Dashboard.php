<?php
session_start();

// Cek apakah pengguna sudah login, jika tidak, redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Ambil data pengguna dari database berdasarkan session user_id (sebagai contoh)
require_once 'config.php';
$user_id = $_SESSION['user_id'];
$query = "SELECT username FROM users WHERE id = '$user_id'";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Halo, <?php echo $user['username']; ?>! Selamat datang di halaman dashboard.</h2>
    <a href="logout.php">Logout</a>
</body>
</html>
