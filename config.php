<?php
// Since PHP 8.1, mysqli throws exceptions on error by default, which would
// bypass the connect_error check below with an uncaught fatal error. Turn
// that off so we can handle connection failures gracefully ourselves.
mysqli_report(MYSQLI_REPORT_OFF);

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
$db_name = getenv('DB_NAME') ?: 'event_db';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset('utf8mb4');
?>
