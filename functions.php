<?php
require_once 'config.php';

function createNote($data)
{
    global $conn;
    mysqli_query($conn, "INSERT INTO notes(id, title, tags, body, color) VALUES ('', '$data[0]', '$data[1]', '$data[2]', '$data[3]')");
}

function getNotes()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM notes ORDER BY updated_at DESC, created_at DESC");
    $notes = [];
    while ($rows = mysqli_fetch_assoc($result)) {
        $tags = explode(", ", $rows["tags"]);
        $rows["tags"] = $tags;
        $notes[] = $rows;
    }
    return $notes;
}

function getNoteById()
{
    global $conn;
    $noteId = $_GET["id"];
    $result = mysqli_query($conn, "SELECT * FROM notes WHERE id = $noteId");
    $note = mysqli_fetch_assoc($result);
    return $note;
}

function findNote($keyword)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM notes WHERE title LIKE '%" . $keyword . "%' OR tags LIKE '%" . $keyword . "%' OR body LIKE '%" . $keyword . "%'");
    $notes = [];
    while ($rows = mysqli_fetch_assoc($result)) {
        $tags = explode(", ", $rows["tags"]);
        $rows["tags"] = $tags;
        $notes[] = $rows;
    }
    return $notes;
}

function register($data)
{
    global $conn;
    if ($data[5] !== $data[6]) {
        header("location: registerPage.php?status=failed&message=invalidpwd");
        exit();
    }

    $pwdHashed = password_hash($data[5], PASSWORD_DEFAULT);
    $result = mysqli_query($conn, "INSERT INTO users(
        id, firstname, lastname, profileImg, username, email, password
        ) VALUES (
        '', '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$pwdHashed'
        )");

    if ($result) {
        header("location: loginPage.php?status=success&message=regsuccess");
        exit();
    } else {
        header("location: registerPage.php?status=failed&message=regfailed");
        exit();
    }
}

function login($data)
{
    global $conn;
    $username = mysqli_query($conn, "SELECT username FROM users WHERE username = '$data[0]'");
    if (mysqli_num_rows($username) == 0) {
        header("location: loginPage.php?status=failed&message=usernamenotfound");
        exit();
    }

    $pwdHashed = mysqli_query($conn, "SELECT password FROM users WHERE username = '$data[0]'");
    $pwdHashed = mysqli_fetch_array($pwdHashed);
    $checkPwd = password_verify($data[1], $pwdHashed[0]);
    if (!$checkPwd) {
        header("location: loginPage.php?status=failed&message=wrongpassword");
        exit();
    } else {
        $user = mysqli_query($conn, "SELECT id, username FROM users WHERE username = '$data[0]' AND password = '$pwdHashed[0]'");
        $user = mysqli_fetch_assoc($user);

        session_start();
        $_SESSION["userid"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("location: index.php");
        exit();
    }
}

function getUser($userid, $username)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$userid' AND username = '$username'");
    $user = mysqli_fetch_assoc($result);

    return $user;
}

function upload()
{
    $namaFileValid = ['jpg', 'jpeg', 'bmp', 'gif', 'tiff', 'svg'];
    $namaFile = strtolower($_FILES["gambar"]["name"]);
    $file = explode(".", $namaFile);
    $tmpName = $_FILES["gambar"]["tmp_name"];
    $encrypt = uniqid();
    $namaFileBaru = $encrypt . "." . $file[1];
    $path = "assets/imgs/" . $namaFileBaru;

    if (!in_array($file[1], $namaFileValid)) {
        header("location: updateProfile.php?status=failed&message=invalidimg");
        exit();
    }

    if ($_FILES["gambar"]["size"] > 2000000) {
        header("location: updateProfile.php?status=failed&message=oversizeimg");
        exit();
    }

    move_uploaded_file($tmpName, $path);
    return $namaFileBaru;
}

function updateProfile($userid, $data)
{
    global $conn;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE) {
        $gambar = upload();
        $result = mysqli_query($conn, "UPDATE users SET profileImg = '$gambar'");
    } else {
        $result = mysqli_query($conn, "UPDATE users SET firstname = '$data[0]', lastname = '$data[1]', username = '$data[2]', email = '$data[3]', hobbies = '$data[4]', description = '$data[5]' WHERE id = $userid");

        if ($result) {
            header("location: profile.php?status=success&message=profileupdt");
            exit();
        } else {
            header("location: updateProfile.php?status=failed&message=failprofileupdt");
            exit();
        }
    }
}