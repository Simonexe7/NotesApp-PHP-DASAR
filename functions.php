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
    $result = mysqli_query($conn, "SELECT * FROM notes");
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

function getUser($userid, $username){
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$userid' AND username = '$username'");
    $user = mysqli_fetch_assoc($result);

    return $user;
}