<?php
require_once 'templates/header.php';
require_once 'config.php';

?>
<div class="container">
    <button type="button" class="btn-back" id="back" onclick="window.history.back()"><ion-icon
            name="chevron-back-outline"></ion-icon> Kembali</button>
    <div class="profile" id="profile">
        <div class="user-profile user-profile-edit">
            <img src="assets/imgs/customer01.jpg" alt="">
            <ion-icon name="pencil-sharp" class="pencil"></ion-icon>
        </div>

        <form action="" method="POST">
            <div class="add-input add-input-profile">
                <input type="file" name="gambar" style="display:none;" id="inputGambar">
                <input type="text" name="firstname" placeholder="Firstname" autofocus>
                <input type="text" name="lastname" placeholder="Lastname">
                <input type="text" name="username" placeholder="Username">
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="hobbies" placeholder="Hobbies">
                <textarea type="text" placeholder="Description" name="body"></textarea>
            </div>
        </form>
    </div>
</div>
<?php require_once 'templates/footer.php'; ?>