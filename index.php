<?php
include "functions.php";
include "data.php";

session_start();

$page_content = renderTemplate('templates/index.php', [
    'categories' => $categories,
    'lots' => $lots,
]);

$layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'title' => 'yeticave - Главная',
    'mainClass' => 'container'
]);

echo $layout_content;