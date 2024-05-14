<?php
require_once 'config.php';

function createNote($data)
{
    global $conn;
    $result = mysqli_query($conn, "INSERT INTO notes(id, title, tags, body, created_at, updated_at) VALUES ('', '$data[0]', '$data[1]', '$data[2]', '', '')");
}