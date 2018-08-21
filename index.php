<?php
require_once('functions.php');
require_once('data.php');
require_once('mysql_helper.php');
require_once('init.php');

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$page_content = renderTemplate('./templates/index.php', ['categories' => get_category_list($link), 'lots' => get_lots_list($link)]);
$layout_content = renderTemplate('./templates/layout.php', ['title' => 'Yeti Cave', 'content' => $page_content, 'categories' => get_category_list($link), 'user' => $user, 'no_nav' => true]);
print($layout_content);
?>