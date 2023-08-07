<?php

return \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', ['Application\Controllers\HomeController', 'index']);
    $route->addRoute('GET', '/hello/{name}', ['Application\Controllers\HomeController', 'hello']);

    // login routes
    $route->addRoute('GET', '/login', ['Application\Controllers\LoginController', 'showLoginForm']);
});
