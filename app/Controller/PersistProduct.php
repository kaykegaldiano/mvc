<?php

namespace App\Controller;

use App\Helper\FlashMessageTrait;
use App\Model\Product;
use App\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PersistProduct implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private EntityRepository $userRepository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $productName = htmlspecialchars(filter_var($request->getParsedBody()['name'], FILTER_SANITIZE_SPECIAL_CHARS));
        $idProduct = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);
        if (!is_null($idProduct) && $idProduct !== false) {
            $product = $this->entityManager->find(Product::class, $idProduct);
            $product->setName($productName);
            $this->defineMessage('success', 'Product updated with success.');
        } else {
            $user = $this->userRepository->findOneBy(['email' => $_SESSION['email']]);
            $product = new Product();
            $product->setName($productName);
            $product->setUser($user);
            $user->getProducts()->add($product);
            $this->entityManager->persist($user);
            $this->entityManager->persist($product);
            $this->defineMessage('success', 'Product created with success.');
        }
        $this->entityManager->flush();
        return new Response(302, ['Location' => '/list-products']);
    }
}