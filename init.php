<?php
require_once 'functions.php';

$link = mysqli_connect('localhost', 'root', '', 'yeticave');

if(!$link) {
    render_error('Ошибка', 'Извините', 'Временные неполадки на сервере');
}
?>