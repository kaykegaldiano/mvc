<?php

namespace App\Controller;

use App\Helper\HtmlViewTrait;
use App\Infra\EntityManagerCreator;
use App\Model\Product;

class ListProducts
{
    use HtmlViewTrait;

    public function handle()
    {
        $productRepository = (new EntityManagerCreator())->getEntityManager()->getRepository(Product::class);
        $products = $productRepository->findAll();
        $title = 'List Products';
        echo $this->getHtmlFromTemplate('products/list.php', compact('products', 'title'));
    }
}