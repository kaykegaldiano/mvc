<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;
use App\Model\Product;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class EditProduct implements RequestHandlerInterface
{
    use TwigViewTrait;

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $idProduct = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);
        if (is_null($idProduct) || $idProduct === false) {
            return new Response(302, ['Location' => '/list-products']);
        }
        $product = $this->entityManager->find(Product::class, $idProduct);
        $title = 'Edit Product';
        $html = $this->getTwigFormTemplate('products/form.html.twig', compact('product', 'title'));
        return new Response(200, [], $html);
    }
}