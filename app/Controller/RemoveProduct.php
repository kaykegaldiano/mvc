<?php

namespace App\Controller;

use App\Helper\FlashMessageTrait;
use App\Infra\EntityManagerCreator;
use App\Model\Product;
use Doctrine\ORM\EntityManagerInterface;

class RemoveProduct
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function handle()
    {
        $idProduct = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (is_null($idProduct) || $idProduct === false) {
            $this->defineMessage('danger', 'Product doesn\'t exist.');
            header('Location: /list-products');
            return;
        }
        $product = $this->entityManager->getReference(Product::class, $idProduct);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
        $this->defineMessage('success', 'Product removed with success.');
        header('Location: /list-products', response_code: 302);
    }
}