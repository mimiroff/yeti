<?php
require_once('data.php');
require_once('functions.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if(isset($_GET['item_id']) && array_key_exists($_GET['item_id'], $goods)) {
    $item_id = $_GET['item_id'];
    $page_content = renderTemplate('./templates/lot.php', ['categories' => $categories, 'item' => $goods[$item_id], 'bets' => $bets, 'lot_time_remaining' => $lot_time_remaining, 'user' => $user]);
    $title = 'Лот №' . $item_id;
} else {
    $title = 404;
    http_response_code($title);
    $page_content = renderTemplate('./templates/error.php', ['message' => 'Страница не найдена']);
}
$layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => $categories, 'user' => $user]);
print($layout_content);
?>