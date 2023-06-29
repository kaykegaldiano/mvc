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
            die();
        }
        $product = new Product();
        $title = 'Register Product';
        echo $this->getTwigFormTemplate('products/form.html', compact('product', 'title'));
    }
}