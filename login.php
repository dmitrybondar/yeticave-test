<?php
include "functions.php";
include "data.php";
include "userdata.php";

session_start();

if(isset($_SESSION['user'])) {
    redirectToIndex();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;

    $required = ['email', 'password'];
    $errors = [];

    foreach ($required as $name) {
        if (!array_key_exists($name, $form) || empty($form[$name])) {
            $errors[$name] = 'Это поле надо заполнить';
        }
    }

    if (!empty($form['email']) && !count($errors)) {
        if ($user = searchUserByEmail($form['email'], $users)) {
            if (password_verify($form['password'], $user['password'])) {
                $_SESSION['user'] = $user;
            }
            else {
                $errors['password'] = 'Неверный пароль';
            }
        }
        else {
            $errors['email'] = 'Такой пользователь не найден';
        }
    }

    if (count($errors)) {
        $page_content = renderTemplate('templates/login.php', [
            'form' => $form,
            'errors' => $errors,
            'categories' => $categories,
        ]);
    }
    else {
        redirectToIndex();
    }
}
else {
    $page_content = renderTemplate('templates/login.php', [
        'categories' => $categories,
    ]);
}

$layout_content = renderTemplate('templates/layout.php', [
    'content' => $page_content,
    'title' => 'Вход на сайт',
    'mainClass' => ''
]);

echo $layout_content;