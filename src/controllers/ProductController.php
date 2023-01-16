<?php

namespace scandi\src\controllers;

use Exception;
use scandi\src\models\Book;
use scandi\src\models\DVD;
use scandi\src\models\Furniture;
use scandi\src\repository\ProductRepository;

class ProductController
{
    private array $errors;
    private ProductRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->errors = [];
    }

    public function findAllProducts(): array
    {
        return $this->productRepository->findAllProducts();
    }

    public function addProduct()
    {
        $this->errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sku = $_POST['SKU'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $selected = $_POST['productType'];
            if (isset($_POST['submitAdd'])) {
                if (!empty($selected)) {
                    try {
                        $this->validate($sku, false);
                        $this->validateSku($sku);
                        $this->validate($name, false);
                        $this->validate($price, true);

                        $this->validateSelection($selected);
                        $value = $_POST['value' . $selected];
                        $this->validate($value, false);
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
                    } catch (Exception $e) {
                        $this->errors[] = $e->getMessage();
                    }
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

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @throws Exception
     */
    private function validate($field, $isNumeric): void
    {
        if ($field == null) {
            throw new Exception("Please, submit required data");
        }
        if ($isNumeric && !is_numeric($field)) {
            throw new Exception("Please, provide the data of indicated type");
        }
    }

    /**
     * @throws Exception
     */
    private function validateSelection($field): void
    {
        if (!in_array($field, array('Book', 'DVD', 'Furniture'))) {
            throw new Exception("Please, submit required data");
        }
    }

    /**
     * @throws Exception
     */
    private function validateSku($sku): void
    {
        if ($this->productRepository->exists($sku)) {
            throw new Exception("The product with the same SKU already exists");
        }
    }
}