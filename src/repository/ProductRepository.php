<?php

namespace scandi\src\repository;

use scandi\src\models\abstracts\Product;
use scandi\src\models\Book;
use scandi\src\models\DVD;
use scandi\src\models\Furniture;
use PDO;

class ProductRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=products', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function deleteProducts(array $productIds)
    {
        foreach ($productIds as $id) {
            $stmt = $this->pdo->prepare("SELECT attribute_value_id FROM products_table WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $attributeValueId = $stmt->fetchColumn();
            $stmt = $this->pdo->prepare("DELETE FROM attribute_values WHERE id = :id");
            $stmt->bindParam(':id', $attributeValueId);
            $stmt->execute();
        }
    }

    public function addProduct(Product $product, string $type)
    {
        $statement = $this->pdo->prepare("SELECT id FROM types_table WHERE type_name = :type");
        $statement->bindParam(':type', $type);
        $statement->execute();
        $type_id = $statement->fetchColumn();

        $statement = $this->pdo->prepare("INSERT INTO attribute_values(value, type_id) VALUES(:value, :type_id)");
        $statement->bindValue(':value', $product->getAttributeValue());
        $statement->bindValue(':type_id', $type_id);
        $statement->execute();

        $attributeValueId = $this->pdo->lastInsertId();

        $statement = $this->pdo->prepare("INSERT INTO products_table(SKU, name, price, attribute_value_id) VALUES(:SKU, :name, :price, :attribute_value_id)");
        $statement->bindValue(':SKU', $product->getSku());
        $statement->bindValue(':name', $product->getName());
        $statement->bindValue(':price', $product->getPrice());
        $statement->bindValue(':attribute_value_id', $attributeValueId);
        $statement->execute();
    }

    public function findAllProducts(): array
    {
        $products = [];
        $books = $this->findAllByTypeName('Book');
        foreach ($books as $value) {
            $products[] = new Book(
                $value['SKU'],
                $value['name'],
                $value['price'],
                $value['value'],
                $value['pid']
            );
        }
        $dvd = $this->findAllByTypeName('DVD');
        foreach ($dvd as $value) {
            $products[] = new DVD(
                $value['SKU'],
                $value['name'],
                $value['price'],
                $value['value'],
                $value['pid']
            );
        }
        $furniture = $this->findAllByTypeName('Furniture');
        foreach ($furniture as $value) {
            $products[] = new Furniture(
                $value['SKU'],
                $value['name'],
                $value['price'],
                $value['value'],
                $value['pid']
            );
        }
        return $products;
    }

    private function findAllByTypeName($type_name)
    {
        $statement = $this->pdo->prepare("SELECT *, product.id AS pid FROM products_table product INNER JOIN attribute_values ON product.attribute_value_id=attribute_values.id INNER JOIN types_table ON attribute_values.type_id=types_table.id WHERE types_table.type_name = :type_name ORDER BY SKU DESC ");
        $statement->bindValue(':type_name', $type_name);
        $statement->execute();
        $products = $statement->fetchALL(PDO::FETCH_ASSOC);
        return $products;
    }
}