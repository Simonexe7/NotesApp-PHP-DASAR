<?php require_once 'config.php'; ?>
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
                <a href="#">
                    <span class="icon">
                        <ion-icon name="settings-outline"></ion-icon>
                    </span>
                </a>
            </li>

            <li>
                <a href="#">
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
                <img src="assets/imgs/customer01.jpg" alt="">
            </div>
        </div>

        <div class="title">
            <h1>Notes App</h1>
        </div>

        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <div class="card">
                <div class="card-title">Daily Views</div>
                <div class="card-body">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex pariatur et repudiandae nihil
                        dolores voluptas hic ipsam exercitationem, magnam, nulla voluptatibus unde error odit
                        temporibus deleniti ipsum illo! Iste, nobis.</p>
                </div>
                <div class="card-footer">
                    <p class="time-create">Mei, 12,2020</p>
                    <div class="action">
                        <ion-icon class="icon" name="create-outline"></ion-icon>
                        <ion-icon class="icon icon_hapus" name="trash-outline"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-title">Daily Views</div>
                <div class="card-body">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex pariatur et repudiandae nihil
                        dolores voluptas hic ipsam exercitationem, magnam, nulla voluptatibus unde error odit
                        temporibus deleniti ipsum illo! Iste, nobis.</p>
                </div>
                <div class="card-footer">
                    <p class="time-create">Mei, 12,2020</p>
                    <div class="action">
                        <ion-icon class="icon" name="create-outline"></ion-icon>
                        <ion-icon class="icon icon_hapus" name="trash-outline"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-title">Daily Views fklasfjfsalfjlaslaffasf</div>
                <div class="card-body">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex pariatur et repudiandae nihil
                        dolores voluptas hic ipsam exercitationem, magnam, nulla voluptatibus unde error odit
                        temporibus deleniti ipsum illo! Iste, nobis.</p>
                </div>
                <div class="card-footer">
                    <p class="time-create">Mei, 12,2020</p>
                    <div class="action">
                        <ion-icon class="icon" name="create-outline"></ion-icon>
                        <ion-icon class="icon icon_hapus" name="trash-outline"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-title">Daily Views</div>
                <div class="card-body">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex pariatur et repudiandae nihil
                        dolores voluptas hic ipsam exercitationem, magnam, nulla voluptatibus unde error odit
                        temporibus deleniti ipsum illo! Iste, nobis.</p>
                </div>
                <div class="card-footer">
                    <p class="time-create">Mei, 12,2020</p>
                    <div class="action">
                        <ion-icon class="icon" name="create-outline"></ion-icon>
                        <ion-icon class="icon icon_hapus" name="trash-outline"></ion-icon>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-title">Daily Views</div>
                <div class="card-body">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex pariatur et repudiandae nihil
                        dolores voluptas hic ipsam exercitationem, magnam, nulla voluptatibus unde error odit
                        temporibus deleniti ipsum illo! Iste, nobis.</p>
                </div>
                <div class="card-footer">
                    <p class="time-create">Mei, 12,2020</p>
                    <div class="action">
                        <ion-icon class="icon" name="create-outline"></ion-icon>
                        <ion-icon class="icon icon_hapus" name="trash-outline"></ion-icon>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- modal -->
    <div class="modal non-active">
        <img src="assets/imgs/question.png" alt="">
        <p class="teks">Apakah Anda Yakin Ingin Menghapus?</p>
        <div class="action">
            <button class="btnIya" onclick="tutupModal()">Iya</button>
            <button class="btnTidak" onclick="tutupModal()">Tidak</button>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>