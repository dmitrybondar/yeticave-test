<?php
session_start();

if(isset($_SESSION['user'])) {
    $currentUser = [
        'userName' => htmlspecialchars($_SESSION['user']['name']),
        'userAvatar' => 'img/user.jpg',
        'isAuthorised' => true,
    ];
} else {
    $currentUser = [
        'userName' => '',
        'isAuthorised' => false,
        'userAvatar' => 'img/unauthorised-user.jpg',
    ];
}