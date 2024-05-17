<?php require_once 'functions.php'; ?>
<?php
$notes = getNotes();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App | Muhammad Farhan</title>
    <!-- ======= Styles ====== -->

    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/bootstrap-5.3.3/dist/css/bootstrap.min.css"> -->
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="navigation active">
        <ul>
            <li>
                <a href="#">
                    <span class="icon">
                        <ion-icon name="logo-apple"></ion-icon>
                    </span>
                </a>
            </li>

            <li>
                <a href="addNote.php">
                    <span class="icon">
                        <ion-icon name="add-circle"></ion-icon>
                    </span>
                </a>
            </li>

            <li>
                <a href="profile.php">
                    <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                    </span>
                </a>
            </li>

            <li>
                <a href="loginPage.php">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                </a>
            </li>
        </ul>
    </div>

    <!-- ========================= Main ==================== -->
    <div class="main active">
        <div class="topbar">

            <div class="search">
                <label>
                    <input type="text" placeholder="Search here">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

            <div class="user">
                <a href="profile.php">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </a>
            </div>
        </div>

        <div class="title">
            <h1>Notes App</h1>
        </div>

        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <?php foreach ($notes as $note): ?>
                <div class="card" id="notes" style="background-color: <?= $note['color']; ?>">
                    <form method="GET">
                        <input type="hidden" name="id" class="noteId" value="<?= $note['id'] ?>">
                    </form>
                    <div class="s-between">
                        <div class="card-header">
                            <div class="card-title"><?= $note["title"]; ?></div>
                            <div class="tags">
                                <?php for ($i = 0; $i < count($note["tags"]); $i++): ?>
                                    <a href="#">#<?= trim($note["tags"][$i]); ?> </a>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <p><?= $note["body"]; ?></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php if ($note["created_at"] == $note["updated_at"]): ?>
                            <div>
                                <p>Created</p>
                                <p class="time-create"><br><?= $note["created_at"]; ?></p>
                            </div>
                        <?php else: ?>
                            <div>
                                <p>Updated</p>
                                <p class="time-create"><br><?= $note["updated_at"]; ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="action">
                            <a href="updateNote.php?id=<?= $note['id'] ?>"><ion-icon class="icon icon_edit"
                                    name="create-outline"></ion-icon></a>
                            <ion-icon class="icon icon_hapus" name="trash-outline"></ion-icon>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- modal -->
    <div class="modal non-active">
        <img src="assets/imgs/question.png" alt="">
        <p class="teks">Apakah Anda Yakin Ingin Menghapus?</p>
        <div class="action">
            <button class="btnIya">Iya</button>
            <button class="btnTidak">Tidak</button>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>