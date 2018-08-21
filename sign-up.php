<?php
require_once('functions.php');
require_once('mysql_helper.php');
require_once('init.php');
require_once('data.php');
require_once ('userdata.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$required = ['email', 'password', 'name', 'message'];
$errors = [];
$errors_messages = ['required' => ['email' => 'Введите e-mail',
    'password' => 'Введите пароль', 'name' => 'Введите имя', 'message' => 'Напишите как с вами связаться'],
    'auth' => ['email' => 'Пользователь с таким e-mail уже зарегистрирован', 'avatar' => 'Неверный формат файла']];
$title = 'Регистрация';
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

if (!$user) {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $page_content = renderTemplate('./templates/sign-up.php', []);
        $_FILES = [];
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fields = $_POST;

        if(is_uploaded_file($_FILES['avatar']['tmp_name'])) {
            if (validateImageType('avatar')) {
                $file_name = $_FILES['avatar']['name'];
                $path = 'img/';
                $file_url = str_replace(' ', '', $path . $file_name);
                move_uploaded_file($_FILES['avatar']['tmp_name'], $file_url);
            } else {
                $errors['avatar'] = $errors_messages['auth']['avatar'];
            }
        }

        foreach ($fields as $key => $value) {
            if (in_array($key, $required) && $value == '') {
                $errors[$key] = $errors_messages['required'][$key];
            }
        }

        if (!count($errors)) {
            if (searchUserByEmail($link, $fields['email'])) {
                $errors['email'] = $errors_messages['auth']['email'];
            } elseif (!validateEmail($fields['email'])) {
                $errors['email'] = $errors_messages['required']['email'];
            }
        }

        if (count($errors)) {
            $page_content = renderTemplate('./templates/sign-up.php', ['fields' => $fields, 'errors' => $errors]);
        } else {
            $email = $fields['email'];
            $name = strip_tags($fields['name']);
            $password = password_hash($fields['password'], PASSWORD_DEFAULT);
            $message = strip_tags($fields['message']);
            $avatar = isset($file_url) ? $file_url : NULL;
            $reg_date = date('Y-m-d H:i:s');
            $sql = 'INSERT INTO users (email, password, register_date, name, contacts, picture) VALUES (?, ?, ?, ?, ?, ?)';
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssss', $email, $password, $reg_date, $name, $message, $avatar);
            mysqli_stmt_execute($stmt);
            header("Location: /login.php");
            exit();
        }
    }
} else {
    header("Location: /index.php");
    exit();
}

$layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => get_category_list($link), 'user' => $user]);

print($layout_content);
?>