<?php
include "functions.php";
include "data.php";

$lot = null;

if (isset($_GET['lot_id'])) {
    $lotId = $_GET['lot_id'];

    foreach ($lots as $key => $item) {
        if ($key == $lotId) {
            $lot = $item;
            break;
        }
    }
}

if (!$lot) {
    http_response_code(404);
}

$page_content = renderTemplate('templates/view.php', [
    'categories' => $categories,
    'bets' => $bets,
    'lot' => $lot,
    'lotTimeRemaining' => $lotTimeRemaining
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