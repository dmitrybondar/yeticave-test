<?php
session_start();

if(isset($_SESSION['user'])) {
    $currentUser = [
        'userName' => strip_tags($_SESSION['user']['name']),
        'userAvatar' => 'img/user.jpg',
    ];
} else {
    $currentUser = null;
}