<?php

namespace Application\Controllers;

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

    public function login()
    {
        try {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->validator->validate();

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
