<?php

use App\Controller\EditProduct;
use App\Controller\InsertProduct;
use App\Controller\ListProducts;
use App\Controller\PersistProduct;
use App\Controller\RemoveProduct;

return [
    '/new-product' => InsertProduct::class,
    '/save-product' => PersistProduct::class,
    '/list-products' => ListProducts::class,
    '/edit-product' => EditProduct::class,
    '/remove-product' => RemoveProduct::class
];