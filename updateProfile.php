<?php
require_once 'templates/header.php';
require_once 'functions.php';

// membuat session
session_start();

// mengumpulkan data session
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];

// mengambil data user berdasarkan data session
$user = getUser($userid, $username);

// mengumpulkan data form ketika tombol submit ditekan
if (isset($_POST["submit"])) {
    $data = array();
    $data[] = htmlspecialchars(trim($_POST["firstname"]));
    $data[] = htmlspecialchars(trim($_POST["lastname"]));
    $data[] = htmlspecialchars(trim($_POST["username"]));
    $data[] = htmlspecialchars(trim($_POST["email"]));
    $data[] = htmlspecialchars(trim($_POST["hobbies"]));
    $data[] = htmlspecialchars(trim($_POST["description"]));

    // menjalankan fungsi mengubah data profile
    updateProfile($userid, $data);
}

?>

<!-- container -->
<div class="container">
    <button type="button" class="btn-back" id="back" onclick="window.location.href = 'profile.php'"><ion-icon
            name="chevron-back-outline"></ion-icon> Kembali</button>
    <div class="profile" id="profile">
        <div class="user-profile user-profile-edit">
            <img src="assets/imgs/<?= $user["profileImg"]; ?>" alt="">
            <ion-icon name="pencil-sharp" class="pencil"></ion-icon>
        </div>

        <!-- form data -->
        <form method="POST" enctype="multipart/form-data">
            <div class="add-input add-input-profile">
                <input type="file" name="gambar" style="display:none;" id="inputGambar" accept="image/*">
                <input type="text" name="firstname" placeholder="Firstname" value="<?= $user["firstname"]; ?>"
                    autofocus>
                <input type="text" name="lastname" placeholder="Lastname" value="<?= $user["lastname"]; ?>">
                <input type="text" name="username" placeholder="Username" value="<?= $user["username"]; ?>">
                <input type="email" name="email" placeholder="Email" value="<?= $user["email"]; ?>">
                <input type="text" name="hobbies" placeholder="Hobbies" value="<?= $user["hobbies"]; ?>">
                <textarea type="text" placeholder="Description"
                    name="description"><?= $user["description"]; ?></textarea>
                <div class="action">
                    <button type="submit" class="btn btn_submit" name="submit">Simpan</button>
                </div>
            </div>
        </form>
    </div>
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
<?php require_once 'templates/footer.php'; ?>