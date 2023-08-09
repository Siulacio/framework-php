<?php

namespace Application\Controllers;

use Aura\Session\Session;

class ProfileController
{

    protected Session $session;
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function index()
    {
    }    

}
