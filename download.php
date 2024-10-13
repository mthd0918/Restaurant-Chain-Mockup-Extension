<?php

require_once 'vendor/autoload.php';
require_once 'Models/User.php';
require_once 'Helpers/RandomGenerator.php';

// POSTリクエストからパラメータを取得
$count = $_POST['count'] ?? 5;
$format = $_POST['format'] ?? 'html';

// パラメータが正しい形式であることを確認
$count = (int)$count;

$numberOfEmployee = 2; // 例: 1企業あたりの従業員数
$minSalary = 30000; // 例: 最低給与
$maxSalary = 100000; // 例: 最高給与
$numberOfLocation = 5; // 例: 1チェーンあたりのロケーション数
$minPostalCode = 10000; // 例: 最小郵便番号
$maxPostalCode = 99999; 

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
        echo $restaurantChain->toMarkdown();
    }
} elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="restaurantChain.json"');
    $restaurantChainArrayArray = array_map(fn($restaurantChain) => $restaurantChain->toArray(), $restaurantChainArray);
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
        
        include "toHTML.php";
    }
}