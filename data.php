<?php
require_once('init.php');

$is_auth = (bool) rand(0, 1);

$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

// устанавливаем часовой пояс в Московское время
date_default_timezone_set('Europe/Moscow');

// записать в эту переменную оставшееся время в этом формате (ЧЧ:ММ)
$lot_time_remaining = "00:00";

// временная метка для полночи следующего дня
$tomorrow = strtotime('tomorrow midnight');

// временная метка для настоящего времени
$now = strtotime('now');

// далее нужно вычислить оставшееся время до начала следующих суток и записать его в переменную $lot_time_remaining
$lot_hours_remaining = str_pad((string) floor(($tomorrow - $now) / 3600), 2, '0', STR_PAD_LEFT);
$lot_minutes_remaininig = str_pad((string) floor((($tomorrow - $now) % 3600) / 60), 2, '0', STR_PAD_LEFT);
$lot_time_remaining = $lot_hours_remaining.':'.$lot_minutes_remaininig;
//$lot_time_remaining = gmdate("H:i:s", $tomorrow - $now);

$lots = [];
$bets = [];

$sql = 'SELECT * FROM bets';

$goods = [
    [
        'title' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 10999,
        'picture_url' => 'img/lot-1.jpg',
        'id' => 0
    ],
    [
        'title' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 159999,
        'picture_url' => 'img/lot-2.jpg',
        'id' => 1
    ],
    [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => 8000,
        'picture_url' => 'img/lot-3.jpg',
        'id' => 2
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => 10999,
        'picture_url' => 'img/lot-4.jpg',
        'id' => 3
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => 7500,
        'picture_url' => 'img/lot-5.jpg',
        'id' => 4
    ],
    [
        'title' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => 5400,
        'picture_url' => 'img/lot-6.jpg',
        'id' => 5
    ]
];

$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];
?>