<?php
date_default_timezone_set('Europe/Moscow');
$tomorrow = strtotime('tomorrow midnight');
$now = strtotime('now');
$remaining_seconds = $tomorrow - $now;
$hours = floor(($remaining_seconds % 86400) / 3600);
$minutes = floor(($remaining_seconds % 3600) / 60);
$lot_time_remaining = $hours . ":" . $minutes;

$is_auth = (bool) rand(0, 1);
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';

include "functions.php";
include "data.php";

$page_content = renderTemplate('templates/index.php',
    ['categories' => $categories, 'lots' => $lots, 'lot_time_remaining' => $lot_time_remaining]);

$layout_content = renderTemplate('templates/layout.php',
    ['content' => $page_content, 'title' => 'yeticave - Главная', 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);

echo $layout_content;