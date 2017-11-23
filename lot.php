<?php
include "functions.php";
include "data.php";

$lot = (isset($_GET['lot_id']) && isset($lots[$_GET['lot_id']])) ? $lots[$_GET['lot_id']] : null;

if (!$lot) {
    http_response_code(404);
}

$page_content = renderTemplate('templates/view.php', [
    'categories' => $categories,
    'bets' => $bets,
    'lot' => $lot,
]);

$layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'title' => 'yeticave - Просмотр лота',
    'isAuth' => $isAuth,
    'userName' => $userName,
    'userAvatar' => $userAvatar,
    'mainClass' => ''
]);

echo $layout_content;