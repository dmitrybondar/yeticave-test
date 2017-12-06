<?php
define('DB_HOST','localhost');
define('DB_LOGIN','root');
define('DB_PASS','');
define('DB_NAME','qyeticave');

$con = @mysqli_connect(DB_HOST, DB_LOGIN, DB_PASS, DB_NAME);
if (!$con) {
    $error = mysqli_connect_error();

    $page_content = renderTemplate('templates/error.php', [
        'error' => $error
    ]);
    $layout_content = renderTemplate('templates/layout.php', [
        'content' => $page_content,
        'title' => 'Ошибка',
        'mainClass' => 'container',
    ]);
    echo $layout_content;

    exit();
}