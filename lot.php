<?php
require_once('./data.php');
require_once('./functions.php');
if(isset($_GET['item_id']) && array_key_exists($_GET['item_id'], $goods)) {
    $item_id = $_GET['item_id'];
    $page_content = renderTemplate('./templates/lot.php', ['categories' => $categories, 'item' => $goods[$item_id], 'bets' => $bets, 'lot_time_remaining' => $lot_time_remaining]);
    $title = 'Лот №' . $item_id;
} else {
    $title = 404;
    http_response_code($title);
    $page_content = renderTemplate('./templates/error.php', ['message' => 'Страница не найдена']);
}
$layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => $categories, 'user_avatar' => $user_avatar]);
print($layout_content);
?>