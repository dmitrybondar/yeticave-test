<?php
include "authorization.php";
include "functions.php";
include "mysql_helper.php";
include "init.php";

if (!$currentUser['isAuthorised']) {
    http_response_code(403);
    redirectTo('/login.php');
}

try {
    $categories = fetchAll($con, 'SELECT * FROM `categories`');
} catch (Exception $e) {
    renderErrorTemplate($e->getMessage(), $currentUser);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

//    echo '<pre>';
//    print_r($lot);
//    print_r($_FILES);
//    echo '</pre>';

    $required = [
        'title',
        'description',
        'category',
        'price',
        'min_bet',
        'end_date',
    ];
    $is_numeric = [
        'price',
        'min-cost'
    ];

    $errors = [];

    foreach ($required as $name) {
        if (!array_key_exists($name, $lot) || empty($lot[$name])) {
            $errors[$name] = 'Это поле надо заполнить';
        }
    }
    foreach ($is_numeric as $name) {
        if (array_key_exists($name, $lot) && $lot[$name] && !is_numeric($lot[$name])) {
            $errors[$name] = 'Введите числовое значение';
        }
    }

    if (!empty($_FILES['img']['name'])) {
        $tmpName = $_FILES['img']['tmp_name'];
        $path = 'img/uploads/' . $_FILES['img']['name'];
        $fileType = $_FILES['img']['type'];

        if ($fileType !== "image/jpeg") {
            $errors['img'] = 'Загрузите картинку в формате jpg';
        } else {
            move_uploaded_file($tmpName, $path);
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
        mysqli_report(MYSQLI_REPORT_ALL);
        try {
            $sql = 'INSERT INTO lots (`start_date`, `category_id`, `user_id`, `title`, `description`, `end_date`, `price`, `min_bet`, `img`) VALUES (NOW(), ?, 3, ?, ?, ?, ?, ?, ?)';
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 'isssiis', $lot['category'], $lot['title'], $lot['description'], $lot['end_date'], $lot['price'], $lot['min_bet'], $lot['img']);
            mysqli_stmt_execute($stmt);
        } catch (Exception $e) {
            renderErrorTemplate($e->getMessage(), $currentUser);
        }

        $lot_id = mysqli_insert_id($con);
        redirectTo("/lot.php?lot_id=" . $lot_id);
        echo "ЛОТ ЗАГРУЖЕН!!!";
    }
} else {
    $page_content = renderTemplate('templates/add_lot.php', [
        'categories' => $categories,
    ]);
}

$layout_content = renderTemplate('templates/layout.php', [
    'categories' => $categories,
    'content' => $page_content,
    'title' => 'Добавить лот',
    'mainClass' => '',
    'currentUser' => $currentUser
]);

echo $layout_content;