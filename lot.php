<?php
require_once('./data.php');
require_once('./functions.php');
if(isset($_GET['item_index']) && array_key_exists($_GET['item_index'], $goods)) {
    $item_index = $_GET['item_index'];
    $page_content = renderTemplate('./templates/lot.php', ['categories' => $categories, 'goods' => $goods, 'bets' => $bets, 'item_index' => $item_index, 'lot_time_remaining' => $lot_time_remaining]);    
} else {
    http_response_code(404);
    $page_content = renderTemplate('./templates/error.php', []);
    
}
$layout_content = renderTemplate('./templates/layout.php', ['title' => 'Yeti Cave', 'content' => $page_content, 'categories' => $categories, 'user_avatar' => $user_avatar, 'user_name' => $user_name, 'is_auth' => $is_auth]);
print($layout_content);
?>