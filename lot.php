<?php
include "functions.php";
include "mysql_helper.php";
include "init.php";
include "data.php";
include "authorization.php";

$lot = (isset($_GET['lot_id']) && isset($lots[$_GET['lot_id']])) ? $lots[$_GET['lot_id']] : null;

$canAddNewBet = true;
$betError = null;

if (!$lot) {
    http_response_code(404);
} else {
    if(isset($_COOKIE['my_bets'])) {
        $array_my_bets = json_decode($_COOKIE['my_bets'], true);
        if(array_key_exists($_GET['lot_id'], $array_my_bets)) {
            $canAddNewBet = false;
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
            setcookie('my_bets', json_encode($array_my_bets), time() + (86400 * 30), '/');
            redirectTo('/mybets.php');
        } else {
            $betError = 'Число должно быть не меньше минимальной ставки';
        }
    }
}

$page_content = renderTemplate('templates/view.php', [
    'categories' => $categories,
    'bets' => $bets,
    'lot' => $lot,
    'canAddNewBet' => $canAddNewBet,
    'betError' => $betError,
    'currentUser' => $currentUser
]);

$layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'title' => 'yeticave - Просмотр лота',
    'mainClass' => '',
    'currentUser' => $currentUser
]);

echo $layout_content;