<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - NotesApp</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container register">
        <h1>Create Account</h1>
        <p>Buat Akunmu terlebih dahulu agar kami dan Notes App dapat mengenal diri kamu.</p>
        <form action="" id="noteForm">
            <div class="fullname">
                <input type="text" placeholder="Firstname">
                <input type="text" placeholder="Lastname">
            </div>
            <input type="text" id="username" placeholder="Username">
            <input type="email" placeholder="Email">
            <input type="password" id="password" placeholder="Password" autocomplete="new-password">
            <ion-icon name="eye-outline" class="eye-r" id="toggleIcon"></ion-icon>
            <input type="password" id="pwdRepeat" placeholder="Ulangi Password" autocomplete="new-password">
            <ion-icon name="eye-outline" class="eye-r2" id="toggleIcon2"></ion-icon>
            <a href="loginPage.php">Sudah punya akun? Masuk halaman Login</a>
            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- =========== Scripts =========  -->
<script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>