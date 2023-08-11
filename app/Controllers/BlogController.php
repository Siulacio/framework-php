<?php

namespace Application\Controllers;

use Application\Providers\Doctrine;
use Application\Providers\View;

class BlogController
{
    public function __construct()
    {
    }

    public function index(Doctrine $doctrine, View $view, ?int $page = 1)
    {
        \Kint::dump($page);
    }

}
