<?php

namespace Application\Controllers;

use Application\Libraries\BCrypt;
use Application\Models\Entities\User;
use Application\Providers\Doctrine;
use Application\Providers\View;
use Aura\Session\Session;
use Symfony\Component\Validator\Validation;

class RegisterController
{
    protected Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function showRegisterForm(View $view)
    {
        echo $view->render('register.twig');
    }

    public function register(Doctrine $doctrine, BCrypt $bcrypt)
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        $user = $doctrine->em->getRepository(User::class)->findOneBy(['email' => $email]);

        if (!$user) {
            $userEntity = new User;
            $userEntity->email = $email;
            $userEntity->name = $name;
            $userEntity->password = $password;

            $validator = Validation::createValidatorBuilder()
                ->enableAnnotationMapping()
                ->getValidator();

            $errors = $validator->validate($userEntity);

            if (count($errors)) {
                $arrayErrors = [];
                foreach ($errors as $error) {
                    $arrayErrors[] = $error->getMessage();
                }

                $this->session->getSegment('Blog')->setFlash('errors', join('<br/>', $arrayErrors));
                $this->session->getSegment('Blog')->setFlash('post', $_POST);
                return redirect('register');
            }

            $userEntity->password = $bcrypt->hash_password($password);
            $doctrine->em->persist($userEntity);
            $doctrine->em->flush();
            $this->session->getSegment('Blog')->setFlash('message', 'Registro correcto, ya puedes acceder');
            return redirect('login');
        }

        $this->session->getSegment('Blog')->setFlash('errors', 'Ya existe un usuario con ese correo electrónico');
        return redirect('register');
    }

}
