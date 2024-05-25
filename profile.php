<?php
require_once 'templates/header.php';
require_once 'functions.php';
session_start();
$userid = $_SESSION["userid"];
$username = $_SESSION["username"];
$user = getUser($userid, $username);
?>
<div class="container">
    <button type="button" class="btn-back" id="back" onclick="window.location.href = 'index.php'"><ion-icon
            name="chevron-back-outline"></ion-icon> Kembali</button>
    <div class="profile" id="profile">
        <div class="user-profile">
            <img src="assets/imgs/<?= $user['profileImg'] ?>" alt="">
        </div>

        <div class="title-profile">
            <h1><?= $user['firstname'] ?> <?= $user['lastname'] ?></h1>
            <button class="btn-edit-profile" id="btnEditProfile"><ion-icon name="create"></ion-icon> Edit
                Profile</button>
        </div>

        <form action="" method="POST">
            <div class="add-input add-input-profile">
                <input type="text" placeholder="Title" name="title" value="Username : <?= $user['username'] ?>"
                    disabled>
                <input type="email" placeholder="Email" name="email" value="Email : <?= $user['email'] ?>" disabled>
                <input type="text" placeholder="Tags" name="tags" value="Hobbies : <?php
                if ($user['hobbies'] == "") {
                    echo "(Kosong)";
                } else {
                    echo $user['hobbies'];
                } ?>" disabled>
                <textarea type="text" placeholder="Body" name="body" disabled>Description : <?php
                if ($user['description'] == "") {
                    echo "(Kosong)";
                } else {
                    echo $user['description'];
                } ?></textarea>
            </div>
        </form>
    </div>
</div>

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