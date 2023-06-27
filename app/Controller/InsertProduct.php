<?php

namespace App\Controller;

use App\Helper\HtmlViewTrait;
use App\Helper\TwigViewTrait as HelperTwigViewTrait;
use App\Model\Product;

class InsertProduct
{
    use HtmlViewTrait;
    use HelperTwigViewTrait;

    public function handle()
    {
        $product = new Product();
        $title = 'Register Product';
        echo $this->getHtmlFromTemplate('products/form.php', compact('product', 'title'));
        // echo $this->getTwigFormTemplate('products/form.html', compact('product', 'title'));
    }
}