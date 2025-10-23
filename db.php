<?php
$DB_HOST = getenv('MYSQL_HOST') ?: '127.0.0.1';
$DB_USER = getenv('MYSQL_USER') ?: 'root';
$DB_PASS = getenv('MYSQL_PASSWORD') ?: '';
$DB_NAME = getenv('MYSQL_DATABASE') ?: 'studyhub';
$DB_PORT = getenv('MYSQL_PORT') ?: '3307';

$dbconn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
if (!$dbconn) {
    die("DB-connection failed: " .mysqli_connect_error());
}
?>
