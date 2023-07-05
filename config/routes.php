<?php

use App\Controller\{
    EditProduct,
    InsertProduct,
    InsertUser,
    ListProducts,
    Login,
    LoginUser,
    Logout,
    PersistProduct,
    PersistUser,
    RemoveProduct
};

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