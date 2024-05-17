<?php
require_once 'templates/header.php';
require_once 'config.php';

?>
<div class="container">
    <button type="button" class="btn-back" id="back" onclick="window.history.back()"><ion-icon
            name="chevron-back-outline"></ion-icon> Kembali</button>
    <div class="profile" id="profile">
        <div class="user-profile">
            <img src="assets/imgs/customer01.jpg" alt="">
        </div>

        <div class="title-profile">
            <h1>Your Profile</h1>
            <button class="btn-edit-profile" id="btnEditProfile"><ion-icon name="create"></ion-icon> Edit
                Profile</button>
        </div>

        <form action="" method="POST">
            <div class="add-input add-input-profile">
                <input type="text" placeholder="Title" name="title" value="Username : " disabled>
                <input type="text" placeholder="Tags" name="tags" value="Hobbies : " disabled>
                <textarea type="text" placeholder="Body" name="body" disabled>Description : </textarea>
            </div>
        </form>
    </div>
</div>
<?php require_once 'templates/footer.php'; ?>