<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$_SESSION = [];
if (isset($_COOKIE['mylots'])) {
    unset($_COOKIE['mylots']);
}
setcookie('mylots', '', time() - 3600, '/');
header("Location: /index.php");
?>