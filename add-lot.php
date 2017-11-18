<?php
require_once('./functions.php');
require_once('./data.php');

$page_content = renderTemplate('./templates/add-lot.php', ['categories' => $categories]);
$layout_content = renderTemplate('./templates/layout.php', ['title' => 'Yeti Cave', 'content' => $page_content, 'categories' => $categories, 'user_avatar' => $user_avatar, 'user_name' => $user_name, 'is_auth' => $is_auth]);

print($layout_content);
?>