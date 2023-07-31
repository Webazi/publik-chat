<?php
// Ganti sesuai dengan konfigurasi MySQL Anda
$host = "localhost";
$username = "nama_pengguna_mysql";
$password = "password_mysql";
$database = "nama_database";

// Koneksi ke database
$connection = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$connection) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
