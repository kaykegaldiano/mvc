<?php

use App\Controller\EditProduct;
use App\Controller\InsertProduct;
use App\Controller\InsertUser;
use App\Controller\ListProducts;
use App\Controller\Login;
use App\Controller\LoginUser;
use App\Controller\Logout;
use App\Controller\PersistProduct;
use App\Controller\PersistUser;
use App\Controller\RemoveProduct;

return [
    '/new-product' => InsertProduct::class,
    '/save-product' => PersistProduct::class,
    '/list-products' => ListProducts::class,
    '/edit-product' => EditProduct::class,
    '/remove-product' => RemoveProduct::class,
    '/signup' => InsertUser::class,
    '/save-user' => PersistUser::class,
    '/login' => LoginUser::class,
    '/make-login' => Login::class,
    '/logout' => Logout::class
];