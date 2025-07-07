<?php
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'studyhub');
define('DB_PORT', '3307');

$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
if (!$dbconn) {
    die("DB-connection failed: " .mysqli_connect_error());
}
?>