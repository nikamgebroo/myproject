<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products', 'root', '');
$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


abstract class allProducts
{   public $errors = [];
    public ?int $id = null;
    public string $sku;
    public string $name;
    public float $price;
    public int $attribute_value_id;
}
if($_SERVER['REQUEST_METHOD'] ==='POST'){
    var_dump($_POST);
    $sku =$_POST['SKU'];
    $name =$_POST['name'];
    $price =$_POST['price'];
    $attribute_value_id =$_POST['attribute_value_id'];



    if(!$sku ){
        $errors[]='product title is required';
    }
    if(!$name ){
        $errors[]='product price is required';
    }
    if(!$price ){
        $errors[]='product price is required';
    }
    if(empty(($errors))){
        $statement = $pdo->prepare("INSERT INTO products(SKU,name, price , price,attribute_value_id)
                    VALUES(:SKU, :name, :price, :attribute_value_id)");
        $statement->bindValue(':SKU', $sku);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':attribute_value_id', $attribute_value_id);
        $statement->execute();
        header('location: main.php');
    }
}