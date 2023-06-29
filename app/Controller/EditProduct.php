<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;
use App\Infra\EntityManagerCreator;
use App\Model\Product;

class EditProduct
{
    use TwigViewTrait;

    public function handle()
    {
        if ($_SESSION['logged'] !== true) {
            header('Location: /login');
            die();
        }
        $idProduct = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $product = (new EntityManagerCreator())->getEntityManager()->find(Product::class, $idProduct);
        $title = 'Edit Product';
        echo $this->getTwigFormTemplate('products/form.html.twig', compact('product', 'title'));
    }
}