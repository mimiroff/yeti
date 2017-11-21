<?php
require_once('./data.php');
require_once('./functions.php');
if(isset($_GET['item_id']) && array_key_exists($_GET['item_id'], $goods)) {
    $item_id = $_GET['item_id'];
    $page_content = renderTemplate('./templates/lot.php', ['categories' => $categories, 'item' => $goods[$item_id], 'bets' => $bets, 'lot_time_remaining' => $lot_time_remaining]);    
} else {
    http_response_code(404);
    $page_content = renderTemplate('./templates/error.php', []);
    
}
$layout_content = renderTemplate('./templates/layout.php', ['title' => 'Yeti Cave', 'content' => $page_content, 'categories' => $categories, 'user_avatar' => $user_avatar, 'user_name' => $user_name, 'is_auth' => $is_auth]);
print($layout_content);
?>