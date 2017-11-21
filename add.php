<?php
require_once('functions.php');
require_once('data.php');

$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
$rules = ['lot-rate' => 'validateNumber', 'lot-step' => 'validateNumber'];
$errors = [];
$errors_messages = ['lot-name' => 'Введите наименование товара',
                    'category' => 'Выберите категорию товара',
                    'message' => 'Оставьте описание товара',
                    'lot-rate' => 'Укажите начальную цену',
                    'lot-step' => 'Укажите шаг цены',
                    'lot-date' => 'Укажите срок размещения товара',
                    'validateNumber' => 'Допускаются только цифры (0-9)'];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $page_content = renderTemplate('./templates/add-lot.php', ['categories' => $categories]);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = $_POST;

    if(isset($_FILES['file']['name'])) {
        $file_name = $_FILES['file']['name'];
        $path = 'img/';
        $file_url = str_replace(' ', '', $path . $file_name);

        move_uploaded_file($_FILES['file']['tmp_name'], $file_url);
    }

    foreach ($item as $key => $value) {
        if (in_array($key, $required) && $value == '' || $key == 'category' && !in_array($value, $categories)) {
            $errors[$key] = $errors_messages[$key];
        }

        if (array_key_exists($key, $rules) && $item[$key] != '') {
            $result = call_user_func($rules[$key], $value);

            if (!$result) {
                $errors[$key] = $errors_messages[$rules[$key]];
            }
        }
        
    }

    if (count($errors)) {
        $page_content = renderTemplate('./templates/add-lot.php', ['categories' => $categories, 'item' => $item, 'errors' => $errors]);
    } else {
        $goods[] = ['title' => $item['lot-name'],
                    'category' => $item['category'],
                    'description' => $item['message'],
                    'price' => $item['lot-rate'],
                    'step' => $item['lot-step'],
                    'date' => $item['lot-date'],
                    'picture_url' => $file_url
                    ];
        $item_id = count($goods) - 1;
        $page_content = renderTemplate('./templates/lot.php', ['categories' => $categories, 'item' => $goods[$item_id], 'bets' => $bets]);
    }
}

$layout_content = renderTemplate('./templates/layout.php', ['title' => 'Yeti Cave', 'content' => $page_content, 'categories' => $categories, 'user_avatar' => $user_avatar, 'user_name' => $user_name, 'is_auth' => $is_auth]);
print($layout_content);
?>