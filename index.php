<?php
include "authorization.php";
include "functions.php";
include "mysql_helper.php";
include "init.php";

//ignat.v@gmail.com
//ug0GdVMi

try {
    $categories = fetchAll($con, 'SELECT * FROM `categories`');
    $lots = fetchAll($con, 'SELECT l.`id`, l.`title`, `img`, `price`, `end_date`, c.`title` AS `category` FROM lots l JOIN categories c ON l.`category_id` = c.`id` WHERE `end_date` > NOW() AND `winner_id` IS NULL;');
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $currentUser);
}

$page_content = renderTemplate('templates/index.php', [
    'categories' => $categories,
    'lots' => $lots,
]);

$layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'title' => 'yeticave - Главная',
    'mainClass' => 'container',
    'currentUser' => $currentUser
]);

echo $layout_content;