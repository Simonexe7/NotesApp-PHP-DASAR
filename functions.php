<?php
require_once 'config.php';

// fungsi untuk membuat note
function createNote($data)
{
    global $conn;
    // query data
    $result = mysqli_query($conn, "INSERT INTO notes(id, title, tags, body, color) VALUES ('', '$data[0]', '$data[1]', '$data[2]', '$data[3]')");

    // cek apakah query berhasil atau gagal
    if ($result) {
        header("location: index.php?status=success&message=addsuccess");
        exit();
    } else {
        header("location: index.php?status=failed&message=addfailed");
        exit();
    }
}

// fungsi untuk mengambil semua data notes
function getNotes()
{
    global $conn;

    // query data
    $result = mysqli_query($conn, "SELECT * FROM notes ORDER BY updated_at DESC, created_at DESC");
    $notes = array();

    // mengumpulkan data query ke dalam array notes
    while ($rows = mysqli_fetch_assoc($result)) {
        $tags = explode(", ", $rows["tags"]);
        $rows["tags"] = $tags;
        $notes[] = $rows;
    }
    return $notes;
}

// fungsi untuk megambil data note berdasarkan id
function getNoteById($noteId)
{
    global $conn;
    // query data
    $result = mysqli_query($conn, "SELECT * FROM notes WHERE id = $noteId");

    // mengambil data query ke variabel note
    $note = mysqli_fetch_assoc($result);
    return $note;
}

// fungsi untuk mengambil notes berdasarkan keyword pencarian
function findNote($keyword)
{
    global $conn;
    // query data
    $result = mysqli_query($conn, "SELECT * FROM notes WHERE title LIKE '%" . $keyword . "%' OR tags LIKE '%" . $keyword . "%' OR body LIKE '%" . $keyword . "%'");
    $notes = array();

    // mengumpulkan data query ke dalam array notes
    while ($rows = mysqli_fetch_assoc($result)) {
        $tags = explode(", ", $rows["tags"]);
        $rows["tags"] = $tags;
        $notes[] = $rows;
    }
    return $notes;
}

// fungsi untuk mengubah data note
function updateNote($noteId, $data){
    global $conn;
    $result = mysqli_query($conn, "UPDATE notes SET title = '$data[0]', tags = '$data[1]', body = '$data[2]', color = '$data[3]', updated_at = NOW() WHERE id = $noteId");
    if ($result) {
        header("location: index.php?status=success&message=updtsuccess");
    } else {
        header("location: index.php?status=failed&message=updtfailed");
    }
}

// fungsi untuk menghapus note
function deleteNote($noteId){
    global $conn;
    $result = mysqli_query($conn, "DELETE FROM notes WHERE id = $noteId");
    if ($result) {
        header("location: index.php?status=success&message=delsuccess");
    } else {
        header("location: index.php?status=failed&message=delfailed");
    }
}

// fungsi untuk membuat akun / register
function register($data)
{
    global $conn;
    // cek apakah password dengan ulangi password sama
    if ($data[5] !== $data[6]) {
        header("location: registerPage.php?status=failed&message=invalidpwd");
        exit();
    }

    // membuat enkripsi password menggunakan hash
    $pwdHashed = password_hash($data[5], PASSWORD_DEFAULT);

    // query data
    $result = mysqli_query($conn, "INSERT INTO users(
        id, firstname, lastname, profileImg, username, email, password
        ) VALUES (
        '', '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$pwdHashed'
        )");

    // cek apakah query berhasil atau tidak
    if ($result) {
        header("location: loginPage.php?status=success&message=regsuccess");
        exit();
    } else {
        header("location: registerPage.php?status=failed&message=regfailed");
        exit();
    }
}

// membuat fungsi login
function login($data)
{
    global $conn;

    // cek apakah username yang diinputkan ada di database
    $username = mysqli_query($conn, "SELECT username FROM users WHERE username = '$data[0]'");
    if (mysqli_num_rows($username) == 0) {
        header("location: loginPage.php?status=failed&message=usernamenotfound");
        exit();
    }

    // ambil password dari database berdasarkan username
    $pwdHashed = mysqli_query($conn, "SELECT password FROM users WHERE username = '$data[0]'");
    $pwdHashed = mysqli_fetch_array($pwdHashed);

    // cek apakah password yang diinputkan sama dengan password di database
    $checkPwd = password_verify($data[1], $pwdHashed[0]);
    if (!$checkPwd) {
        header("location: loginPage.php?status=failed&message=wrongpassword");
        exit();
    } else {
        // ambil data user berdasarkan username dan password
        $user = mysqli_query($conn, "SELECT id, username FROM users WHERE username = '$data[0]' AND password = '$pwdHashed[0]'");
        $user = mysqli_fetch_assoc($user);

        // masukkan data user ke dalam session
        session_start();
        $_SESSION["userid"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("location: index.php");
        exit();
    }
}

// fungsi untuk mengambil data user berdasarkan data session
function getUser($userid, $username)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$userid' AND username = '$username'");
    $user = mysqli_fetch_assoc($result);

    return $user;
}

// fungsi untuk mengupload gambar ke server
function upload()
{
    $namaFileValid = ['jpg', 'jpeg', 'bmp', 'gif', 'tiff', 'svg'];
    $namaFile = strtolower($_FILES["gambar"]["name"]);
    $file = explode(".", $namaFile);
    $tmpName = $_FILES["gambar"]["tmp_name"];
    $encrypt = uniqid();
    $namaFileBaru = $encrypt . "." . $file[1];
    $path = "assets/imgs/" . $namaFileBaru;

    // cek apakah file yang diupload merupakan gambar
    if (!in_array($file[1], $namaFileValid)) {
        header("location: updateProfile.php?status=failed&message=invalidimg");
        exit();
    }

    // cek apakah ukuran file lebih dari 2MB
    if ($_FILES["gambar"]["size"] > 2000000) {
        header("location: updateProfile.php?status=failed&message=oversizeimg");
        exit();
    }

    move_uploaded_file($tmpName, $path);
    return $namaFileBaru;
}

// fungsi untuk mengubah data akun
function updateProfile($userid, $data)
{
    global $conn;
    // cek apakah foto profil diubah atau tidak
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
        $gambar = upload();
        $result = mysqli_query($conn, "UPDATE users SET profileImg = '$gambar'");
    }

    // update data akun ke database
    $result = mysqli_query($conn, "UPDATE users SET firstname = '$data[0]', lastname = '$data[1]', username = '$data[2]', email = '$data[3]', hobbies = '$data[4]', description = '$data[5]' WHERE id = $userid");
    if ($result) {
        header("location: profile.php?status=success&message=profileupdt");
        exit();
    } else {
        header("location: updateProfile.php?status=failed&message=failprofileupdt");
        exit();
    }
}