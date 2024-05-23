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