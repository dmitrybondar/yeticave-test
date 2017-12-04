<?php
include "functions.php";
include "mysql_helper.php";
include "init.php";
include "data.php";
include "authorization.php";

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