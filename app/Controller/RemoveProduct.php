<?php

namespace App\Controller;

use App\Infra\EntityManagerCreator;
use App\Model\Product;
use Doctrine\ORM\EntityManagerInterface;

class RemoveProduct
{
    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function handle()
    {
        $idProduct = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (is_null($idProduct) || $idProduct === false) {
            header('Location: /list-products');
            return;
        }
        $product = $this->entityManager->getReference(Product::class, $idProduct);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
        header('Location: /list-products', response_code: 302);
    }
}