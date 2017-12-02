<?php
require_once ('functions.php');

$link = mysqli_connect('localhost', 'rot', '', 'yeticave');

if(!$link) {
    $title = 'Ошибка';
    $error = 'Извините';
    $page_content = renderTemplate('./templates/error.php', ['message' => 'Временные неполадки на сервере', 'error' => $error]);
    $layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => $categories, 'user' => $user]);
    print($layout_content);
    exit;
}
?>