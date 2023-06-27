<?php

namespace App\Controller;

use App\Infra\EntityManagerCreator;
use App\Model\Product;

class RemoveProduct
{
    public function handle()
    {
        $idProduct = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $product = $entityManager->find(Product::class, $idProduct);
        $entityManager->remove($product);
        $entityManager->flush();
        header('Location: /list-products', response_code: 302);
    }
}