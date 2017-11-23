<?php
require_once('./functions.php');
require_once('./data.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$page_content = renderTemplate('./templates/index.php', ['categories' => $categories, 'goods' => $goods, 'lot_time_remaining' => $lot_time_remaining]);
$layout_content = renderTemplate('./templates/layout.php', ['title' => 'Yeti Cave', 'content' => $page_content, 'categories' => $categories, 'user' => $user]);

print($layout_content);
?>