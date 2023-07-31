<?php
session_start();
require_once 'config.php';

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan hashing kata sandi sebelum menyimpannya ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan data pengguna ke dalam tabel
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Jika pendaftaran berhasil, Anda dapat mengarahkan pengguna ke halaman login
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Terjadi kesalahan saat melakukan pendaftaran.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>REGISTER</title>
</head>
<body>
    <h2>bUAT aKUN aCUmaLAKA</h2>
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" name="signup" value="Sign Up">
    </form>
</body>
</html>
