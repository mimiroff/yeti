<?php
require_once('functions.php');
require_once('mysql_helper.php');
require_once('init.php');
require_once('data.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date', 'file'];
$rules = ['lot-rate' => 'validateNumber', 'lot-step' => 'validateNumber'];
$errors = [];
$errors_messages = ['lot-name' => 'Введите наименование товара',
                    'category' => 'Выберите категорию товара',
                    'message' => 'Оставьте описание товара',
                    'lot-rate' => 'Укажите начальную цену',
                    'lot-step' => 'Укажите шаг цены',
                    'lot-date' => 'Укажите срок размещения товара',
                    'file' => 'Загрузите фото товара',
                    'validateNumber' => 'Допускаются только цифры (0-9)',
                    'validateFileType' => 'Неверный формат файла'];

$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if(!$user) {
    $title = 403;
    render_error($title, http_response_code($title), 'Доступ запрещён');
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $title = 'Добавить лот';
        $page_content = renderTemplate('./templates/add-lot.php', ['categories' => get_category_list($link)]);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $item = $_POST;

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            if (mime_content_type($_FILES['file']['tmp_name']) == 'image/png' || mime_content_type($_FILES['file']['tmp_name']) == 'image/jpeg') {
                $file_name = $_FILES['file']['name'];
                $path = 'img/';
                $file_url = str_replace(' ', '', $path . $file_name);
                move_uploaded_file($_FILES['file']['tmp_name'], $file_url);
            } else {
                $errors['file'] = $errors_messages['validateFileType'];
            }
        }

        foreach ($item as $key => $value) {
            if (in_array($key, $required) && $value == '' || $key == 'category' && !in_array($value, get_category_list($link))) {
                $errors[$key] = $errors_messages[$key];
            }

            if (array_key_exists($key, $rules) && $item[$key] != '') {
                $result = call_user_func($rules[$key], $value);

                if (!$result) {
                    $errors[$key] = $errors_messages[$rules[$key]];
                }
            }
        }

        if ($errors) {
            $title = 'Добавить лот';
            $page_content = renderTemplate('./templates/add-lot.php', ['item' => $item, 'categories' => get_category_list($link), 'errors' => $errors]);
        } else {
            $date = date('Y-m-d H:i:s');
            $name = $item['lot-name'];
            $description = $item['message'];
            $picture = $file_url;
            $price = $item['lot-rate'];
            $step = $item['lot-step'];
            $expire_date = date('Y-m-d H:i:s',strtotime($item['lot-date']));
            $author_id = $user['id'];
            $category = get_category_id($link, $item['category'])[0]['id'];
            $sql = 'INSERT INTO lots (date, name, description, picture, price, step, expire_date, author_id, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssiisii', $date, $name, $description, $picture, $price, $step, $expire_date, $author_id, $category);
            mysqli_stmt_execute($stmt);

            $item_id = get_last_id($link, 'lots');
            $title = $name;
            $page_content = renderTemplate('./templates/lot.php', ['item' => get_current_lot($link, $item_id)[0], 'bets' => get_lot_bets($link, $item_id), 'user' => $user]);
        }
    }
}


$layout_content = renderTemplate('./templates/layout.php', ['title' => 'Лот', 'content' => $page_content, 'categories' => get_category_list($link), 'user' => $user]);
print($layout_content);
?>