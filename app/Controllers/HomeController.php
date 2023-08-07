<?php

namespace Application\Controllers;

use Application\Models\Entities\User;
use Application\Providers\Doctrine;

class HomeController
{
    protected $doctrine;

    public function __construct(Doctrine $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function index()
    {
        $user = $this->doctrine->em->getRepository(User::class)->find(1);
        \Kint::dump($user);
    }
}
