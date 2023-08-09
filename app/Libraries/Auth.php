<?php

namespace Application\Libraries;

use Aura\Session\Session;

class Auth
{
    protected Session $session;
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function generateUserSession($user)
    {
        $this->session->getSegment('Blog')->set('user', [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
        ]);
    }

}
