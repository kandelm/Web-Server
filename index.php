<?php
$conn = new mysqli('localhost', 'web_user', 'StrongPassword123', 'web_db');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
$time = date('Y-m-d H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
echo 'Visitor IP: ' . $ip . '<br> Current Time: ' . $time;
$conn->close();
?>
