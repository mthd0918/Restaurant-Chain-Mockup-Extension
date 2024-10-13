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
$restaurantChains = \Helpers\RandomGenerator::restaurantChains(
    $numberOfEmployee,
    $minSalary,
    $maxSalary,
    $numberOfLocation,
    $minPostalCode,
    $maxPostalCode
);

if ($format === 'markdown') {
    header('Content-Type: text/markdown');
    header('Content-Disposition: attachment; filename="restaurantChain.md"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $user->toMarkdown();
    }
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="restaurantChain.json"');
    $restaurantChainArrayArray = array_map(fn($user) => $user->toArray(), $restaurantChainArray);
    echo json_encode($restaurantChainArrayArray);
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="restaurantChain.txt"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toString();
    }
} else {
    // HTMLをデフォルトに
    header('Content-Type: text/html');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toHTML();
    }
}