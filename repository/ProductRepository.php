<?php

class ProductRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=products', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function findAllProducts()
    {
        $products = [];
        $books = $this->findAllByTypeName('Book');
        foreach ($books as $value) {
            array_push($products, new Book($value . sku … .));}
        return $products;

    }

    private function findAllByTypeName($type_name)
    {
        $statement = $this->pdo->prepare("SELECT * FROM products_table INNER JOIN attribute_values ON products_table.attribute_value_id=attribute_values.id INNER JOIN types_table ON attribute_values.type_id=types_table.id WHERE types_table.type_name = :type_name ORDER BY SKU DESC ");
        $statement->bindValue(':type_name', $type_name);
        $statement->execute();
        $products = $statement->fetchALL(PDO::FETCH_ASSOC);
        return $products;
    }
}