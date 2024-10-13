<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Chain Mockup</title>
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php foreach ($restaurantChains as $chainIndex => $chain): ?>
        <div class="container">
            <h2 class="m-4 text-center">Restaurant Chain: <?php echo $chain->name; ?></h2>
            <div class="card">
                <div class="card-header d-flex align-items-center bg-secondary">
                    <p class="m-0 text-light">Restaurant Chain Information</p>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordion_<?php echo $chainIndex ?>">
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
                                        <div class="card">
                                            <div class="card-body">
                                                <p><?php echo $location->toHTML() ?></p>
                                                <h6>Employees: </h6>
                                                <table class="table table-bordered">
                                                    <?php foreach($location->employees() as $employee): ?>
                                                        <tr><td><?php echo $employee->toHTML(); ?></td></tr>
                                                    <?php endforeach; ?>
                                                </table>
                                            </div>
                                        </div>
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