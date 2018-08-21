<?php
require_once('data.php');
require_once('functions.php');
require_once('mysql_helper.php');
require_once('init.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if($user && $bets = get_user_bets($link, $user['id'])) {
    $title = 'Мои ставки';
    $page_content = renderTemplate('./templates/mylots.php', ['title' => $title, 'mybets' => $bets]);
} else {
    $title = 404;
    http_response_code($title);
    render_error($title, http_response_code(), 'Страница не найдена');
}

$layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => get_category_list($link), 'user' => $user]);
print($layout_content);
?>