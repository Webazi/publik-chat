<?php
session_start();
require_once 'config.php';

// Cek apakah pengguna sudah login, jika ya, redirect ke halaman lain
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}



// Jika tombol login ditekan
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query ke database untuk mencari pengguna yang sesuai
    $query = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Jika verifikasi berhasil, set session dan redirect ke halaman lain
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "PW ENTE SALAH MASSE.";
        }
    } else {
        $error_message = "Username te aya.";
    }


}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <style>
      body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
            background-image: url("https://wallpapercave.com/wp/wp2742508.jpg");
        #chat-container {
            width: 400px;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            color: white;
            box-shadow: 4px, 4px, 4px black solid;
            background-image: url("https://th.bing.com/th/id/R.d218ce1a0433640671e2fbdb697f8e24?rik=mUNH36eZqOqrsQ&riu=http%3a%2f%2fi.stack.imgur.com%2fXcZ1s.png&ehk=piHOdLC2W3yFV%2bvH4T07PU0IBFKFsyqYf85qLCleI7I%3d&risl=&pid=ImgRaw&r=0");
        }
        #chat-button {
            margin: 50px;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        a {
            color: white;
        }
    </style>
</head>
<body>
    <div id="chat-container">
    <h2>aYO kITA cHaT Masuk pakai akun yg udh di buat</h2>
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    
    <form method="post">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" id="chat-button" name="login" value="Login">
    </form>

<p>tidak ada akun? buat akun <a href="signup.php"a>Sign up</a></p>
</div>
</body>
</html>


