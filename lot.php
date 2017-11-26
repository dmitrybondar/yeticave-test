<?php
include "functions.php";
include "data.php";

$lot = (isset($_GET['lot_id']) && isset($lots[$_GET['lot_id']])) ? $lots[$_GET['lot_id']] : null;

if (!$lot) {
    http_response_code(404);
}

$hide_bets = false;
$bet_error = null;

if(isset($_COOKIE['my_lots'])) {
    $array_my_bets = unserialize($_COOKIE['my_lots']);
    if(array_key_exists($_GET['lot_id'], $array_my_bets)) {
        $hide_bets = true;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(intval($_POST['cost']) >= $lot['min-cost']) {
        $new_bet = [
            "id" => $_GET['lot_id'],
            "cost" => $_POST['cost'],
            "title" => $lot['title'],
            "img" => $lot['img'],
            "category" => $lot['category'],
            "lot_date" => $lot['date'],
            "bet_date" => strtotime('now'),
        ];
        $array_my_bets[$_GET['lot_id']] = $new_bet;
        setcookie('my_lots', serialize($array_my_bets), time() + (86400 * 30), '/');
        header('Location: /mylots.php');
    } else {
        $bet_error = 'Число должно быть не меньше минимальной ставки';
    }
}

$page_content = renderTemplate('templates/view.php', [
    'categories' => $categories,
    'bets' => $bets,
    'lot' => $lot,
    'hide_bets' => $hide_bets,
    'bet_error' => $bet_error
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