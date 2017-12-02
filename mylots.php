<?php
require_once('data.php');
require_once('functions.php');
require_once('mysql_helper.php');
require_once('init.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if($user && isset($_COOKIE['mylots'])) {
    $title = 'Мои ставки';
    $mybets = json_decode($_COOKIE['mylots'], true);
    $mybets_full = [];
    for ($i = 0; $i < count($mybets); $i++) {
        $mybets_full[$i]['cost'] = $mybets[$i]['cost'];
        $mybets_full[$i]['time'] = get_past_time($mybets[$i]['time']);
        $mybets_full[$i]['lot_id'] = $mybets[$i]['lot-id'];
        $mybets_full[$i]['title'] = $goods[$mybets[$i]['lot-id']]['title'];
        $mybets_full[$i]['picture_url'] = $goods[$mybets[$i]['lot-id']]['picture_url'];
        $mybets_full[$i]['date'] = isset($goods[$mybets[$i]['lot-id']]['date']) ? $goods[$mybets[$i]['lot-id']]['date'] : $lot_time_remaining;
        $mybets_full[$i]['category'] = $goods[$mybets[$i]['lot-id']]['category'];
    }
    $page_content = renderTemplate('./templates/mylots.php', ['title' => $title, 'categories' => $categories, 'mybets' => $mybets_full]);
} else {
    $title = 404;
    http_response_code($title);
    $page_content = renderTemplate('./templates/error.php', ['message' => 'Страница не найдена']);
}

$layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => $categories, 'user' => $user]);
print($layout_content);
?>