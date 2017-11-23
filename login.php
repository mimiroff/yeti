<?php
require_once('functions.php');
require_once('data.php');
require_once ('userdata.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$required = ['email', 'password'];
$errors = [];
$errors_messages = ['required' => ['email' => 'Введите свой email',
                                   'password' => 'Введите пароль'],
                    'auth' => ['email' => 'Такой пользователь не найден',
                               'password' => 'Вы ввели неверный пароль']];
$title = 'Вход';
$user = null;

if (!isset($_SESSION['user']) && $_SERVER['REQUEST_METHOD'] == 'GET') {
    $page_content = renderTemplate('./templates/login.php', ['categories' => $categories]);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                $_SESSION['user']['user_pic'] = $user_avatar;
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
        $user = $_SESSION['user'];
        header("Location: /index.php");
        exit();
    }
} else {
    header("Location: /index.php");
    exit();
}

$layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => $categories, 'user' => $user]);

print($layout_content);
?>