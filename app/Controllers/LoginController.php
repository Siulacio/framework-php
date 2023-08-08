<?php

namespace Application\Controllers;

use Application\Libraries\Auth;
use Application\Libraries\BCrypt;
use Application\Models\Entities\User;
use Application\Providers\Doctrine;
use Application\Providers\View;
use Application\Validators\LoginValidator;
use Aura\Session\Session;
use Respect\Validation\Exceptions\NestedValidationException;

class LoginController
{
    protected View $view;
    protected LoginValidator $validator;
    protected Session $session;

    public function __construct(View $view, LoginValidator $validator, Session $session)
    {
        $this->view = $view;
        $this->validator = $validator;
        $this->session = $session;
    }

    public function showLoginForm()
    {
        echo $this->view->render('login.twig');
    }

    public function login(Doctrine $doctrine, BCrypt $bcrypt, Auth $auth)
    {
        try {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->validator->validate();

            $user = $doctrine->em->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user) {
                if ($bcrypt->check_password($password, $user->password)) {
                    $auth->generateUserSession($user);
                    return redirect('profile');
                }
            }

            $this->session->getSegment('Blog')->setFlash('errors', 'Los datos son incorrectos.');
            return redirect('login');

        } catch (NestedValidationException $exception) {
            $errors = $exception->findMessages($this->validator->getMessages());
            if (count($errors)) {
                $arrayErrors = [];
                foreach ($errors as $key => $message) {
                    if ($message) {
                        $arrayErrors[] = $message;
                    }
                }

                $this->session->getSegment('Blog')->setFlash('errors', join('<br/>', $arrayErrors));
                $this->session->getSegment('Blog')->setFlash('post', $_POST);
                return redirect('login');
            }
        }
    }
}
