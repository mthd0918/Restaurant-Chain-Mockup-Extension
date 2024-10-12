<?php

require_once 'vendor/autoload.php';
require_once 'Models/User.php';
require_once 'Helpers/RandomGenerator.php';

// POSTリクエストからパラメータを取得
$count = $_POST['count'] ?? 5;
$format = $_POST['format'] ?? 'html';

// パラメータが正しい形式であることを確認
$count = (int)$count;

// ユーザーを生成
$restaurantChains = \Helpers\RandomGenerator::restaurantChains($count, $count);

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="users.md"');
    foreach ($users as $user) {
        echo $user->toMarkdown();
    }
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="users.json"');
    $usersArray = array_map(fn($user) => $user->toArray(), $users);
    echo json_encode($usersArray);
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="users.txt"');
    foreach ($users as $user) {
        echo $user->toString();
    }
} else {
    // HTMLをデフォルトに
    header('Content-Type: text/html');
    foreach ($users as $user) {
        echo $user->toHTML();
    }
}