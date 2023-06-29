<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;
use App\Infra\EntityManagerCreator;
use App\Model\Product;

class ListProducts
{
    use TwigViewTrait;

    public function handle()
    {
        if ($_SESSION['logged'] !== true) {
            header('Location: /login');
            die();
        }
        $productRepository = (new EntityManagerCreator())->getEntityManager()->getRepository(Product::class);
        $products = $productRepository->findAll();
        $title = 'List Products';
        echo $this->getTwigFormTemplate('products/list.html', compact('products', 'title'));
    }
}