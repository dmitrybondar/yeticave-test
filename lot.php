<?php
include "authorization.php";
include "functions.php";
include "mysql_helper.php";
include "init.php";

$canAddNewBet = true;
$betError = null;

$lot_id = (isset($_GET['lot_id'])) ? intval($_GET['lot_id']) : null;
try {
    $categories = fetchAll($con, 'SELECT * FROM `categories`');
    $lot = fetchOne($con, 'SELECT l.`title`, `img`, `description`, `price`, `end_date`, `min_bet`, c.`title` AS `category` FROM lots l JOIN categories c ON l.`category_id` = c.`id` WHERE `end_date` > NOW() AND `winner_id` IS NULL AND l.`id` = ' . $lot_id);
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $currentUser);
}

//print '<pre>';
//print_r($lot);
//print '</pre>';

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

$page_content = renderTemplate('templates/view.php', [
    'categories' => $categories,
//    'bets' => $bets,
    'bets' => '',
    'lot' => $lot,
    'canAddNewBet' => $canAddNewBet,
    'betError' => $betError,
    'currentUser' => $currentUser
]);

$layout_content = renderTemplate('templates/layout.php', [
    'categories' => $categories,
    'content' => $page_content,
    'title' => 'yeticave - Просмотр лота',
    'mainClass' => '',
    'currentUser' => $currentUser
]);

echo $layout_content;