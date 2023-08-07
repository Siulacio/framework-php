<?php

use Application\Controllers\HomeController;
use Application\Providers\Doctrine;
use Application\Providers\View;
use Application\Utils\TwigFunctions;

return [
    'config.database' => function () {
        return parse_ini_file(base_path('app/Config/database.ini'));
    },
    HomeController::class => \DI\create()->constructor(\DI\get(Doctrine::class)),
    Doctrine::class => function (\Psr\Container\ContainerInterface $container) {
        return new Doctrine($container);
    },
    View::class => \DI\create(View::class),
    'SharedContainerTwig' => function(\Psr\Container\ContainerInterface $container) {
        TwigFunctions::setContainer($container);
    }
];
