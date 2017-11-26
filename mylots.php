<?php
include "functions.php";
include "data.php";

$array_my_bets = [];
if(isset($_COOKIE['my_lots'])) {
    $array_my_bets = unserialize($_COOKIE['my_lots']);
}

$page_content = renderTemplate('templates/my_lots.php', [
    'array_my_bets' => $array_my_bets,
    'categories' => $categories,
    'lots' => $lots,
]);

$layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'title' => 'Мои лоты',
    'isAuth' => $isAuth,
    'userName' => $userName,
    'userAvatar' => $userAvatar,
    'mainClass' => ''
]);

echo $layout_content;