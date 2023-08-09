<?php

return \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', ['Application\Controllers\HomeController', 'index']);
    $route->addRoute('GET', '/hello/{name}', ['Application\Controllers\HomeController', 'hello']);

    // login routes
    $route->addRoute('GET', '/login', ['Application\Controllers\LoginController', 'showLoginForm']);
    $route->addRoute('POST', '/login', ['Application\Controllers\LoginController', 'login']);

    // register routes
    $route->addRoute('GET', '/register', ['Application\Controllers\RegisterController', 'showRegisterForm']);
    $route->addRoute('POST', '/register', ['Application\Controllers\RegisterController', 'register']);
});
