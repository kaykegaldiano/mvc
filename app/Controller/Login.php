<?php

namespace App\Controller;

use App\Infra\EntityManagerCreator;
use App\Model\User;

class Login
{
    public function handle()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $userRepository = $entityManager->getRepository(User::class);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $user = $userRepository->findOneBy(['email' => $email]);
        
        if (is_null($user) || !$user->checkPasswordIsCorrect($password)) {
            header('Location: /login?invalid=true', response_code: 302);
            die();
        }
    }
}