<?php
include "functions.php";
include "data.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

    $required = [
        'title',
        'description',
        'category',
        'price',
        'min-cost',
        'date',
        'img'
    ];
    $is_numeric = [
        'price',
        'min-cost'
    ];

    $errors = [];

    foreach ($required as $name) {
        if (array_key_exists($name, $lot) && !$lot[$name]) {
            $errors[$name] = 'Это поле надо заполнить';
        }
    }
    foreach ($is_numeric as $name) {
        if (array_key_exists($name, $lot) && $lot[$name] && !is_numeric($lot[$name])) {
            $errors[$name] = 'Введите числовое значение';
        }
    }

    if (!empty($_FILES['img']['name'])) {
        $tmp_name = $_FILES['img']['tmp_name'];
        $path = 'img/uploads/' . $_FILES['img']['name'];
        $file_type = $_FILES['img']['type'];

        if ($file_type !== "image/jpeg") {
            $errors['img'] = 'Загрузите картинку в формате jpg';
        } else {
            move_uploaded_file($tmp_name, $path);
            $lot['img'] = $path;
        }
    } else {
        $errors['img'] = 'Вы не загрузили файл';
    }

    if (count($errors)) {
        $page_content = renderTemplate('templates/add_lot.php', [
            'errors' => $errors,
            'lot' => $lot,
            'categories' => $categories,
        ]);
    } else {
        $page_content = renderTemplate('templates/view.php', [
            'lot' => $lot,
            'categories' => $categories,
            'bets' => $bets,
        ]);
    }
} else {
    $page_content = renderTemplate('templates/add_lot.php', [
        'categories' => $categories,
    ]);
}

$layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'title' => 'Добавить лот',
    'isAuth' => $isAuth,
    'userName' => $userName,
    'userAvatar' => $userAvatar,
    'mainClass' => ''
]);

echo $layout_content;