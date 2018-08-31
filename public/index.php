<?php

require_once __DIR__ . '/../bootstrap/bootstrap.php';

use App\Cursor;
use App\MagneticPoint;

try {
    $cursor = new Cursor();

    $magneticPoints = [
        new MagneticPoint(50, 50, 5),
        new MagneticPoint(51, 51, 5),
    ];

    $coordinates = $cursor->withMagneticPoints($magneticPoints)->move(51, 52);

    echo "X: {$coordinates[0]}, Y: {$coordinates[1]}" . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}