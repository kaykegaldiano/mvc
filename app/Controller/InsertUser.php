<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class InsertUser implements RequestHandlerInterface
{
    use TwigViewTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->getTwigFormTemplate('signup/form.html.twig', ['title' => 'Sign Up']);
        return new Response(200, [], $html);
    }
}