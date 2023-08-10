<?php

namespace Application\Controllers;

use Application\Providers\View;
use Aura\Session\Session;

class ProfileController
{

    protected Session $session;
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function index(View $view)
    {
        echo $view->render('profile.twig');
    }

    public function logout()
    {
        $this->session->getSegment('Blog')->clear();
        $this->session->getSegment('Blog')->setFlash('message', 'Has cerrado sesión correctamente');
        return redirect('login');
    } 

}
