<?php
include "authorization.php";
include "functions.php";
include "mysql_helper.php";
include "init.php";

//$lot = (isset($_GET['lot_id']) && isset($lots[$_GET['lot_id']])) ? $lots[$_GET['lot_id']] : null;

$canAddNewBet = true;
$betError = null;

$id = intval($_GET['lot_id']);
//$sql = "SELECT gifs.id, title, path, description, show_count, like_count, users.name, category_id FROM gifs "
//    . "JOIN users ON gifs.user_id = users.id "
//    . "WHERE gifs.id = " . $id;

try {
    $lot = getSqlData($con, 'array', 'SELECT l.`id`, l.`title`, `img`, `price`, `end_date`, c.`title` AS `category` FROM lots l JOIN categories c ON l.`category_id` = c.`id` WHERE `end_date` > NOW() AND `winner_id` IS NULL AND l.`id` = ' . $id);
    // print '<pre>';
    print_r($lot);
    // print '</pre>';
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $currentUser);
}

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