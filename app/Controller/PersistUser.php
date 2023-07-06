<?php

namespace App\Controller;

use App\Model\User;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistUser implements RequestHandlerInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $name = htmlspecialchars(filter_var($request->getParsedBody()['name'], FILTER_SANITIZE_SPECIAL_CHARS));
        $email = filter_var($request->getParsedBody()['email'], FILTER_SANITIZE_EMAIL);
        $document = filter_var($request->getParsedBody()['document'], FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_var($request->getParsedBody()['phone'], FILTER_SANITIZE_SPECIAL_CHARS);
        $birthDate = filter_var($request->getParsedBody()['date'], FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($request->getParsedBody()['confirmPassword']);

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setDocument(str_replace(['.', '-'], '', $document));
        $user->setPhone(str_replace(['+', ' ', '-'], '', $phone));
        $user->setPassword($password);
        $user->setBirthDate(new DateTime(str_replace('/', '-', $birthDate)));
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return new Response(302, ['Location' => '/login']);
    }
}