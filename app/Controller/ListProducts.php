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
        $productRepository = (new EntityManagerCreator())->getEntityManager()->getRepository(Product::class);
        $products = $productRepository->findAll();
        $title = 'List Products';
        echo $this->getTwigFormTemplate('products/list.html', compact('products', 'title'));
    }
}