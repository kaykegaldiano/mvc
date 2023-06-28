<?php

namespace App\Controller;

use App\Helper\HtmlViewTrait;
use App\Helper\TwigViewTrait;
use App\Infra\EntityManagerCreator;
use App\Model\Product;

class EditProduct
{
    use HtmlViewTrait;
    use TwigViewTrait;

    public function handle()
    {
        $idProduct = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $product = (new EntityManagerCreator())->getEntityManager()->find(Product::class, $idProduct);
        $title = 'Edit Product';
        echo $this->getHtmlFromTemplate('products/form.php', compact('product', 'title'));
        // echo $this->getTwigFormTemplate('products/form.html', compact('product', 'title'));
    }
}