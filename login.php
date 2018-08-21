<?php
require_once('functions.php');
require_once('mysql_helper.php');
require_once('init.php');
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
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (!$user) {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $page_content = renderTemplate('./templates/login.php', []);
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fields = $_POST;

        foreach ($fields as $key => $value) {
            if (in_array($key, $required) && $value == '') {
                $errors[$key] = $errors_messages['required'][$key];
            }
        }
        if (!count($errors)) {
            if ($user = searchUserByEmail($link, $fields['email'])) {
                if (password_verify($fields['password'], $user[0]['password'])) {
                    $_SESSION['user'] = $user[0];
                } else {
                    $errors['password'] = $errors_messages['auth']['password'];
                }
            } else {
                $errors['email'] = $errors_messages['auth']['email'];
            }
        }

        if (count($errors)) {
            $page_content = renderTemplate('./templates/login.php', ['fields' => $fields, 'errors' => $errors]);
        } else {
            header("Location: /index.php");
            exit();
        }
    }
} else {
    header("Location: /index.php");
    exit();
}

$layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => get_category_list($link), 'user' => $user]);

print($layout_content);
