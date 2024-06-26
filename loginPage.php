<?php

require_once "functions.php";
// simpan data form ketika tombol submit ditekan
if (isset($_POST["submit"])) {
    $data = [];
    $data[] = htmlspecialchars(trim($_POST["username"]));
    $data[] = htmlspecialchars(trim($_POST["password"]));

    // jalankan fungsi login
    login($data);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - NotesApp</title>
    <link rel="shortcut icon" href="assets/imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <!-- container -->
    <div class="container">
        <h1>Sign In</h1>
        <p>Halo, Selamat datang!! Agar dapat masuk ke aplikasi Notes App kamu harus login terlebih dulu ya.</p>
        <form method="POST" id="noteForm">
            <input type="text" id="username" placeholder="Masukkan Username" name="username" required>
            <ion-icon name="person-outline" class="person"></ion-icon>
            <input type="password" id="password" placeholder="Masukkan Password" autocomplete="new-password"
                name="password" required>
            <ion-icon name="eye-outline" class="eye" id="toggleIcon"></ion-icon>
            <a href="registerPage.php">Belum punya akun? Buat Akun dulu</a>
            <button type="submit" name="submit">Sign In</button>
        </form>
    </div>

    <!-- modal msg -->
    <div class="bg-modal">
        <div class="modal">
            <img src="" alt="">
            <p class="teks"></p>
            <div class="action">
                <button class="btn-1"></button>
                <button class="btn-2"></button>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>