<?php

namespace App\Controller;

use App\Helper\FlashMessageTrait;
use App\Infra\EntityManagerCreator;
use App\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class Login
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;
    private ObjectRepository $userRepository;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }
    
    public function handle()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if (is_null($email) || $email === false) {
            $this->defineMessage('danger', 'E-mail is not valid.');
            header('Location: /login', response_code: 302);
            return;
        }

        /** @var User $user */
        $user = $this->userRepository->findOneBy(['email' => $email]);
        
        if (is_null($user) || !$user->checkPasswordIsCorrect($password)) {
            $this->defineMessage('danger', 'E-mail or password invalids');
            header('Location: /login', response_code: 302);
            return;
        }

        $_SESSION['logged'] = true;
        $_SESSION['email'] = $email;
        header('Location: /list-products', response_code: 302);
    }
}