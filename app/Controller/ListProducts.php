<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;
use App\Infra\EntityManagerCreator;
use App\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ListProducts implements RequestHandlerInterface
{
    use TwigViewTrait;

    private EntityRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->userRepository = $entityManager->getRepository(User::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $user = $this->userRepository->findOneBy(['email' => $_SESSION['email']]);
        $username = explode(' ', $user->getName())[0];
        $products = $user->getProducts();
        $title = 'List Products';
        $html = $this->getTwigFormTemplate('products/list.html.twig', compact('products', 'title', 'username'));
        return new Response(200, [], $html);
    }
}