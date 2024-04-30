<?php
error_reporting(-1);
ini_set("display_errors", "On");

$uri = $_SERVER['REQUEST_URI'];
$ur = explode('/',$uri);
$view = $ur[1];
$menu = 'menu.php';

if(count($ur)>2) $userID = $ur[2];

if(empty($view)) {
    $a = 'home.php';
}
else if(file_exists('../views/'.$view.'.php')){
    $a = $view.'.php';
}
else {
    $a = '404.php';
}

if ($view == 'users' || $view == 'user') {
    $example_users = [
        1 => [
            'name' => 'John',
            'surname' => 'Doe',
            'age' => 21
        ],
        2 => [
            'name' => 'Peter',
            'surname' => 'Bauer',
            'age' => 16
        ],
        3 => [
            'name' => 'Paul',
            'surname' => 'Smith',
            'age' => 18
        ]
    ];
    if ($view == 'user') {
        if (!isset($userID) || $userID>sizeof($example_users)) $a = '404.php';
        else $user = $example_users[$userID];
    }
    else {
        $users = $example_users;
    }
    unset($example_users);
}

require_once('../views/layout.php');