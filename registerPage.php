<?php require_once "functions.php";

// mengumpulkan data form ketika tombol submit ditekan
if (isset($_POST["submit"])) {
    $data = array();
    $data[] = htmlspecialchars(trim($_POST["firstname"]));
    $data[] = htmlspecialchars(trim($_POST["lastname"]));
    $data[] = htmlspecialchars(trim($_POST["profileImg"]));
    $data[] = htmlspecialchars(trim($_POST["username"]));
    $data[] = htmlspecialchars(trim($_POST["email"]));
    $data[] = htmlspecialchars(trim($_POST["password"]));
    $data[] = htmlspecialchars(trim($_POST["pwdRepeat"]));

    // jalankan fungsi register
    register($data);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - NotesApp</title>
    <link rel="shortcut icon" href="assets/imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>

    <!-- container -->
    <div class="container register">
        <h1>Create Account</h1>
        <p>Buat Akunmu terlebih dahulu agar kami dan Notes App dapat mengenal diri kamu.</p>

        <!-- form data -->
        <form method="POST" id="noteForm">
            <input type="hidden" name="profileImg" value="user.svg">
            <div class="fullname">
                <input type="text" placeholder="Firstname" name="firstname" required>
                <input type="text" placeholder="Lastname" name="lastname" required>
            </div>
            <input type="text" id="username" placeholder="Username" name="username" required>
            <input type="email" placeholder="Email" name="email" required>
            <input type="password" id="password" placeholder="Password" autocomplete="new-password" name="password"
                required>
            <ion-icon name="eye-outline" class="eye-r" id="toggleIcon"></ion-icon>
            <input type="password" id="pwdRepeat" placeholder="Ulangi Password" autocomplete="new-password"
                name="pwdRepeat" required>
            <ion-icon name="eye-outline" class="eye-r2" id="toggleIcon2"></ion-icon>
            <a href="loginPage.php">Sudah punya akun? Masuk halaman Login</a>
            <button type="submit" name="submit">Buat Akun</button>
        </form>
    </div>

    <!-- modal -->
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