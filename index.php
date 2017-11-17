<?php
require_once('./functions.php');
require_once('./data.php');

$page_content = renderTemplate('./templates/index.php', ['categories' => $categories, 'goods' => $goods, 'lot_time_remaining' => $lot_time_remaining]);
$layout_content = renderTemplate('./templates/layout.php', ['title' => 'Yeti Cave', 'content' => $page_content, 'categories' => $categories, 'user_avatar' => $user_avatar, 'user_name' => $user_name, 'is_auth' => $is_auth]);

print($layout_content);
?>