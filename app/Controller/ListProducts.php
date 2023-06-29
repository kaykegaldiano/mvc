<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;
use App\Infra\EntityManagerCreator;
use App\Model\User;

class ListProducts
{
    use TwigViewTrait;

    public function handle()
    {
        if ($_SESSION['logged'] !== true) {
            header('Location: /login');
            die();
        }
        $userRepository = (new EntityManagerCreator())->getEntityManager()->getRepository(User::class);
        $user = $userRepository->findOneBy(['email' => $_SESSION['email']]);
        $username = explode(' ', $user->getName())[0];
        $products = $user->getProducts();
        $title = 'List Products';
        echo $this->getTwigFormTemplate('products/list.html.twig', compact('products', 'title', 'username'));
    }
}