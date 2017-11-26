<?php
require_once('data.php');
require_once('functions.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$errors = [];
$mybets = isset($_COOKIE['mylots']) ? json_decode($_COOKIE['mylots'], true) : [];
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['item_id']) && array_key_exists($_GET['item_id'], $goods)) {
        $item_id = $_GET['item_id'];
        $is_bet = find_matching_in_array($mybets, 'lot-id', $item_id);
        $page_content = renderTemplate('./templates/lot.php', ['categories' => $categories, 'item' => $goods[$item_id], 'bets' => $bets, 'is_bet' => $is_bet, 'lot_time_remaining' => $lot_time_remaining, 'user' => $user]);
        $title = 'Лот №' . $item_id;
    } else {
        $title = 404;
        http_response_code($title);
        $page_content = renderTemplate('./templates/error.php', ['message' => 'Страница не найдена']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $is_bet = find_matching_in_array($mybets, 'lot-id', $_POST['lot-id']);
    if($is_bet || !$user) {
        $title = 403;
        http_response_code($title);
        $page_content = renderTemplate('./templates/error.php', ['message' => 'Доступ запрещен']);
    } else {
        $bet['cost'] = $_POST['cost'];
        $bet['lot-id'] = $_POST['lot-id'];
        $bet['time'] = time();
        $result = call_user_func('validateNumber', $bet['cost']);
        if (!$result) {
            $errors['cost'] = 'Введите целое число';
        }
        if (count($errors)) {
            $page_content = renderTemplate('./templates/lot.php', ['categories' => $categories, 'item' => $goods[$bet['lot-id']], 'bets' => $bets, 'is_bet' => $is_bet, 'lot_time_remaining' => $lot_time_remaining, 'user' => $user, 'errors' => $errors]);
            $title = 'Лот №' . $bet['lot-id'];
        } else {
            $mybets[] = $bet;
            setcookie('mylots', json_encode($mybets), strtotime('+7 days'));
            header("Location: /mylots.php");
        }
    }
}
$layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => $categories, 'user' => $user]);
print($layout_content);
?>