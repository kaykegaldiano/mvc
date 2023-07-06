<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class InsertProduct implements RequestHandlerInterface
{
    use TwigViewTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->getTwigFormTemplate('products/form.html.twig', ['title' => 'New Product']);
        return new Response(200, [], $html);
    }
}