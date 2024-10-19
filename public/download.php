<?php

require_once 'vendor/autoload.php';
require_once 'Models/User.php';
require_once 'Helpers/RandomGenerator.php';

// POSTリクエストからパラメータを取得
$numberOfEmployee = $_POST["numberOfEmployee"] ?? 3;
$salary = $_POST['salary'] ?? 3;
$numberOfLocation = $_POST['numberOfLocation'] ?? 3;
$minPostalCode = $_POST['minPostalCode'] ?? "000-0000";
$maxPostalCode = $_POST['maxPostalCode'] ?? "999-9999";
$format = $_POST['format'] ?? 'html';

// パラメータが正しい形式であることを確認
$numberOfEmployee = (int)$numberOfEmployee;

$salary = 0;

switch ($salary) {
    case '20000':
        $minSalary = 20000;
        $maxSalary = 49999;
        break;
    case '50000':
        $minSalary = 50000;
        $maxSalary = 79999;
        break;
    case '80000':
        $minSalary = 80000;
        $maxSalary = PHP_INT_MAX; // 上限なし
        break;
    default:
        $minSalary = 20000;
        $maxSalary = 49999;
        break;
}

$minSalary = (int)$minSalary;
$maxSalary = (int)$maxSalary;

$minPostalCode = (int)str_replace("-", "", $minPostalCode);
$maxPostalCode = (int)str_replace("-", "", $maxPostalCode);

$format = (string)$format;

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
}  elseif ($format === 'json') {
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="restaurantChain.json"');
    echo json_encode($restaurantChains);
} elseif ($format === 'txt') {
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="restaurantChain.txt"');
    foreach ($restaurantChains as $restaurantChain) {
        echo $restaurantChain->toString();
    }
} else {
    // HTMLをデフォルトに
    header('Content-Type: text/html');
        
        include "toHTML.php";
}