<?php
require_once "config.php";

$noteId = $_GET['id'];
mysqli_query($conn, "DELETE FROM notes WHERE id = $noteId");
header("location: index.php");