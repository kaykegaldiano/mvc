<?php

namespace App\Controller;

use App\Helper\FlashMessageTrait;
use App\Infra\EntityManagerCreator;
use App\Model\Product;
use App\Model\User;
use Doctrine\ORM\EntityManagerInterface;

class PersistProduct
{
    use FlashMessageTrait;

    private EntityManagerInterface $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function handle()
    {
        $productName = htmlspecialchars(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
        $idProduct = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!is_null($idProduct) && $idProduct !== false) {
            $product = $this->entityManager->find(Product::class, $idProduct);
            $product->setName($productName);
            $this->defineMessage('success', 'Product updated with success.');
        } else {
            $userRepository = $this->entityManager->getRepository(User::class);
            $user = $userRepository->findOneBy(['email' => $_SESSION['email']]);
            $product = new Product();
            $product->setName($productName);
            $product->setUser($user);
            $user->getProducts()->add($product);
            $this->entityManager->persist($user);
            $this->entityManager->persist($product);
            $this->defineMessage('success', 'Product created with success.');
        }
        $this->entityManager->flush();
        header('Location: /list-products', response_code: 302);
    }
}