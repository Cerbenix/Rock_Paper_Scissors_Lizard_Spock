<?php declare(strict_types=1);

require_once 'vendor/autoload.php';

$controller = new \App\Controllers\GameController();

$router = new \App\CLI\GameModeRouter($controller);
$router->run();
