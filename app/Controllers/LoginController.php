<?php

namespace Application\Controllers;

use Application\Providers\View;

class LoginController
{
    protected View $view;
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function showLoginForm()
    {
        echo $this->view->render('login.twig');
    }

}
