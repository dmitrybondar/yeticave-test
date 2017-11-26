<?php
$isAuth = (bool) rand(0, 1);
$userName = 'Константин';
$userAvatar = 'img/user.jpg';

$categories = [
    [
        'title' => 'Доски и лыжи',
        'class' => 'boards',
    ],
    [
        'title' => 'Крепления',
        'class' => 'attachment',
    ],
    [
        'title' => 'Ботинки',
        'class' => 'boots',
    ],
    [
        'title' => 'Одежда',
        'class' => 'clothing',
    ],
    [
        'title' => 'Инструменты',
        'class' => 'tools',
    ],
    [
        'title' => 'Разное',
        'class' => 'other',
    ]
];

$lots = [
    [
        'title' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '10999',
        'min-cost' => '12000',
        'img' => 'img/lot-1.jpg',
        'description' => 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчком и четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.',
        'date' => '2017-11-25'
    ],
    [
        'title' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => '159999',
        'min-cost' => '17200',
        'img' => 'img/lot-2.jpg',
        'description' => 'Легкий маневренный сноуборд',
        'date' => '2017-11-30'
    ],
    [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => '8000',
        'min-cost' => '9000',
        'img' => 'img/lot-3.jpg',
        'description' => 'Очень крутые крепления',
        'date' => '2017-12-02'
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => '10999',
        'min-cost' => '11999',
        'img' => 'img/lot-4.jpg',
        'description' => 'Лучшие ботинки',
        'date' => '2017-12-05'
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => '7500',
        'min-cost' => '8000',
        'img' => 'img/lot-5.jpg',
        'description' => 'Удобная куртка',
        'date' => '2017-11-29'
    ],
    [
        'title' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => '5400',
        'min-cost' => '7000',
        'img' => 'img/lot-6.jpg',
        'description' => '',
        'date' => '2017-12-11'
    ]
];

$bets = [
    [
        'name' => 'Иван',
        'price' => 11500,
        'ts' => strtotime('-' . rand(1, 50) .' minute')
    ],
    [
        'name' => 'Константин',
        'price' => 11000,
        'ts' => strtotime('-' . rand(1, 18) .' hour')
    ],
    [
        'name' => 'Евгений',
        'price' => 10500,
        'ts' => strtotime('-' . rand(25, 50) .' hour')
    ],
    [
        'name' => 'Семён',
        'price' => 10000,
        'ts' => strtotime('last week')
    ]
];