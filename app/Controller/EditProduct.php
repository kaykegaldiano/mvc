<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;
use App\Infra\EntityManagerCreator;
use App\Model\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class EditProduct
{
    use TwigViewTrait;

    private EntityManagerInterface $entityManager;
    private ObjectRepository $productsRepository;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->productsRepository = $this->entityManager->getRepository(Product::class);
    }

    public function handle()
    {
        if ($_SESSION['logged'] !== true) {
            header('Location: /login');
            return;
        }
        $idProduct = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (is_null($idProduct) || $idProduct === false) {
            header('Location: /list-products');
            return;
        }
        $product = $this->productsRepository->find($idProduct);
        $title = 'Edit Product';
        echo $this->getTwigFormTemplate('products/form.html.twig', compact('product', 'title'));
    }
}