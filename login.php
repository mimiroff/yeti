<?php
require_once('functions.php');
require_once('data.php');
require_once ('userdata.php');

$required = ['email', 'password'];
$errors = [];
$errors_messages = ['required' => ['email' => 'Введите свой email',
                                   'password' => 'Введите пароль'],
                    'auth' => ['email' => 'Такой пользователь не найден',
                               'password' => 'Вы ввели неверный пароль']];
$title = 'Вход';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $page_content = renderTemplate('./templates/login.php', ['categories' => $categories]);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $fields = $_POST;

    foreach ($fields as $key => $value) {
        if (in_array($key, $required) && $value == '') {
            $errors[$key] = $errors_messages['required'][$key];
        }
    }
    if (!count($errors)) {
        if ($user = searchUserByEmail($fields['email'], $users)) {
            if (password_verify($fields['password'], $user['password'])) {
                $_SESSION['user'] = $user;
            } else {
                $errors['password'] = $errors_messages['auth']['password'];
            }
        } else {
            $errors['email'] = $errors_messages['auth']['email'];
        }
    }

    if (count($errors)) {
        $page_content = renderTemplate('./templates/login.php', ['categories' => $categories, 'fields' => $fields, 'errors' => $errors]);
    } else {
        header("Location: /index.php");
        exit();
    }
}

$layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => $categories, 'user_avatar' => $user_avatar]);

print($layout_content);
?>