<?php

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder;
$containerBuilder->useAutowiring(false);
//load container configurations
$containerBuilder->addDefinitions(base_path('bootstrap/config.php'));

try {
    //creates the container
    $container = $containerBuilder->build();
    return $container;
} catch (Exception $e) {
}
