<?php
require_once('data.php');
require_once('functions.php');
require_once('mysql_helper.php');
require_once('init.php');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$errors = [];
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
$mybets = $user ? get_user_bets($link, $user['id']) : [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['item_id']) && find_row($link, $_GET['item_id'])) {
        $item_id = $_GET['item_id'];
        $is_bet = find_matching_in_array($mybets, 'lot_id', $item_id);
        $is_author = check_author($link, $user['id'], $item_id);
        $is_time_left = is_time_left(get_current_lot($link, $item_id)[0]['expire_date']);
        $page_content = renderTemplate('./templates/lot.php', ['item' => get_current_lot($link, $item_id)[0], 'bets' => get_lot_bets($link, $item_id), 'is_bet' => $is_bet, 'is_author' => $is_author, 'is_time_left' => $is_time_left, 'user' => $user]);
        $title = 'Лот №' . $item_id;
    } else {
        $title = 404;
        http_response_code($title);
        render_error($title, http_response_code(), 'Страница не найдена');
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $is_bet = find_matching_in_array($mybets, 'lot-id', $_POST['lot-id']);
    if($is_bet || !$user) {
        $title = 403;
        render_error($title, http_response_code($title), 'Доступ запрещён');
    } else {
        $bet['cost'] = $_POST['cost'];
        $bet['lot-id'] = $_POST['lot-id'];
        $bet['time'] = time();
        $result = call_user_func('validateNumber', $bet['cost']);
        if (!$result) {
            $errors['cost'] = 'Введите целое число';
        }
        if (count($errors)) {
            $page_content = renderTemplate('./templates/lot.php', ['item' => $goods[$bet['lot-id']], 'bets' => $bets, 'is_bet' => $is_bet, 'lot_time_remaining' => $lot_time_remaining, 'user' => $user, 'errors' => $errors]);
            $title = 'Лот №' . $bet['lot-id'];
        } else {
            $mybets[] = $bet;
            setcookie('mylots', json_encode($mybets), strtotime('+7 days'));
            header("Location: /mylots.php");
        }
    }
}
$layout_content = renderTemplate('./templates/layout.php', ['title' => $title, 'content' => $page_content, 'categories' => get_category_list($link), 'user' => $user]);
print($layout_content);
?>