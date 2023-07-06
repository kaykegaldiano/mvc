<?php

namespace App\Controller;

use App\Helper\FlashMessageTrait;
use App\Model\Product;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RemoveProduct implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $idProduct = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);
        if (is_null($idProduct) || $idProduct === false) {
            $this->defineMessage('danger', 'Product doesn\'t exist.');
            return new Response(302, ['Location' => '/list-products']);
        }
        $product = $this->entityManager->getReference(Product::class, $idProduct);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
        $this->defineMessage('success', 'Product removed with success.');
        return new Response(302, ['Location' => '/list-products']);
    }
}