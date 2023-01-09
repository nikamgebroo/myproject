<?php

namespace scandi\src\controllers;

use scandi\src\models\Book;
use scandi\src\models\DVD;
use scandi\src\models\Furniture;
use scandi\src\repository\ProductRepository;

class ProductController
{
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function findAllProducts(): array
    {
        return $this->productRepository->findAllProducts();
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sku = $_POST['SKU'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $selected = $_POST['productType'];
            $value = $_POST['value' . $selected];
            if (isset($_POST['submitAdd'])) {
                if (!empty($selected)) {
                    switch ($selected) {
                        case 'Book':
                            $this->productRepository->addProduct(new Book($sku, $name, $price, $value), $selected);
                            break;
                        case 'DVD':
                            $this->productRepository->addProduct(new DVD($sku, $name, $price, $value), $selected);
                            break;
                        case 'Furniture':
                            $this->productRepository->addProduct(new Furniture($sku, $name, $price, $value), $selected);
                            break;
                    }
                    header('location: main.php');
                }
            }
        }
    }

    public function deleteProducts()
    {
        if (isset($_POST["submit1"])) {
            $productIds = $_POST['num'];
            $this->productRepository->deleteProducts($productIds);
            header('location: main.php');
        }
    }
}