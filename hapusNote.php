<?php
require_once "config.php";

$noteId = $_GET['id'];
$result = mysqli_query($conn, "DELETE FROM notes WHERE id = $noteId");
if ($result) {
    header("location: index.php?status=success&message=delsuccess");
} else {
    header("location: index.php?status=failed&message=delfailed");
}