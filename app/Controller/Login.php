<?php

namespace App\Controller;

use App\Infra\EntityManagerCreator;
use App\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class Login
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $userRepository;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }
    
    public function handle()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        /** @var User $user */
        $user = $this->userRepository->findOneBy(['email' => $email]);
        
        if (is_null($user) || !$user->checkPasswordIsCorrect($password)) {
            $_SESSION['logged'] = false;
            header('Location: /login', response_code: 302);
            return;
        }

        $_SESSION['logged'] = true;
        $_SESSION['email'] = $email;
        header('Location: /list-products', response_code: 302);
    }
}