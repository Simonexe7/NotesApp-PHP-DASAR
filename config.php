<?php
define('SITE_TITLE', "Notes App");
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'notes_app');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);