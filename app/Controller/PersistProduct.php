<?php

namespace App\Controller;

use App\Infra\EntityManagerCreator;
use App\Model\Product;
use App\Model\User;

class PersistProduct
{
    public function handle()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $productName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $idProduct = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!is_null($idProduct) && $idProduct !== false) {
            $product = $entityManager->find(Product::class, $idProduct);
            $product->setName($productName);
        } else {
            $userRepository = $entityManager->getRepository(User::class);
            $user = $userRepository->findOneBy(['email' => $_SESSION['email']]);
            $product = new Product();
            $product->setName($productName);
            $product->setUser($user);
            $user->getProducts()->add($product);
            $entityManager->persist($user);
            $entityManager->persist($product);
        }

        $entityManager->flush();
        header('Location: /list-products', response_code: 302);
    }
}