<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;
use App\Model\Product;

class InsertProduct
{
    use TwigViewTrait;

    public function handle()
    {
        if ($_SESSION['logged'] !== true) {
            header('Location: /login');
            return;
        }
        $product = new Product();
        $title = 'New Product';
        echo $this->getTwigFormTemplate('products/form.html.twig', compact('product', 'title'));
    }
}