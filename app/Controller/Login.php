<?php

namespace App\Controller;

use App\Helper\FlashMessageTrait;
use App\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Login implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private ObjectRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->userRepository = $entityManager->getRepository(User::class);
    }
    
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = filter_var($request->getParsedBody()['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($request->getParsedBody()['password']);

        if (is_null($email) || $email === false) {
            $this->defineMessage('danger', 'E-mail is not valid.');
            return new Response(302, ['Location' => '/login']);
        }

        /** @var User $user */
        $user = $this->userRepository->findOneBy(['email' => $email]);
        
        if (is_null($user) || !$user->checkPasswordIsCorrect($password)) {
            $this->defineMessage('danger', 'E-mail or password invalids');
            return new Response(302, ['Location' => '/login']);
        }

        $_SESSION['logged'] = true;
        $_SESSION['email'] = $email;
        
        return new Response(302, ['Location' => '/list-products']);
    }
}