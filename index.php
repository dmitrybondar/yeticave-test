<?php
include "functions.php";
include "data.php";

$page_content = renderTemplate('templates/index.php', ['categories' => $categories, 'lots' => $lots]);

$layout_content = renderTemplate('templates/layout.php',
    ['content' => $page_content, 'title' => 'yeticave - Главная']);

echo $layout_content;
