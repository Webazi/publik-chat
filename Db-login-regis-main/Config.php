<?php
// Ganti sesuai dengan konfigurasi MySQL Anda
$host = "localhost";
$username = "root";
$password = "";
$database = "login";

// Koneksi ke database
$connection = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$connection) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
