<?php
// コードベースのファイルのオートロード
spl_autoload_extensions(".php"); 
spl_autoload_register();

// composerの依存関係のオートロード
require_once 'vendor/autoload.php';

use Helpers\RandomGenerator;

// // クエリ文字列からパラメータを取得
$min = $_GET['min'] ?? 5;
$max = $_GET['max'] ?? 20;

// // パラメータが整数であることを確認
$min = (int)$min;
$max = (int)$max;

$restaurantChains = RandomGenerator::restaurantChains(1, 2);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Restaurant Chain Mockup</title>
        <!-- Bootstrap CSS -->
        <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Bundle JS (includes Popper) -->
        <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php foreach ($restaurantChains as $chainIndex => $chain): ?>
            <div class="container">
                <!-- restaurant chain name -->
                <h2 class="m-4 text-center">Restaurant Chain: <?php echo $chain->name; ?></h2>
                <!-- restaurant chain card -->
                <div class="card">
                    <!-- card-header -->
                    <div class="card-header d-flex align-items-center">
                        <p class="m-0">Restaurant Chain Information</p>
                    </div>
                    <!-- card-body -->
                    <div class="card-body">
                            <div class="accordion" id="accordion_<?php echo $chainIndex ?>">
                            <!-- accordion: chain detail info -->
                            <?php foreach ($chain->restaurantLocations as $locationIndex => $location): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#collapse_<?php echo $chainIndex ?>_<?php echo $locationIndex ?>" 
                                                aria-expanded="false" aria-controls="collapse_<?php echo $chainIndex ?>_<?php echo $locationIndex ?>">
                                            <?php echo $location->name; ?>
                                        </button>
                                    </h2>
                                    <div id="collapse_<?php echo $chainIndex ?>_<?php echo $locationIndex ?>" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <?php echo $location->toHTML() ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </body>
</html>