<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare('SELECT * FROM products_table INNER JOIN attribute_values ON products_table.attribute_value_id=attribute_values.id INNER JOIN types_table ON attribute_values.type_id=types_table.id ORDER BY SKU DESC');
$statement->execute();
$products = $statement->fetchALL(PDO::FETCH_ASSOC);
$value = '';
if (isset($_POST["submit1"])) {
    $deleteProduct = $_POST['num'];
    foreach ($deleteProduct as $id) {
        $sql = "DELETE FROM attribute_values WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        header('location: main.php');
    }
}
$errors = [];
$SKU = '';
$name = '';
$price = '';
$attribute_value_id = '';
$value = '';
$type_id = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $SKU = $_POST['SKU'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    if (isset($_POST['submitAdd'])) {
        if (!empty($_POST['productType'])) {
            $selected = $_POST['productType'];
            $st = $pdo->prepare("SELECT id FROM types_table WHERE type_name=:type_name LIMIT 1");
            $st->bindParam(":type_name", $selected);
            $st->execute();
            $type_id = $st->fetchColumn();
            $value = $_POST['value' . $selected];
        }
    }
        $statement = $pdo->prepare("INSERT INTO attribute_values(value,type_id)
                    VALUES(:value, :type_id)");
        $statement->bindValue(':value', $value);
        $statement->bindValue(':type_id', $type_id);
        $statement->execute();

    $lastInsertId = $pdo->lastInsertId();
    if (true) {
        $st = $pdo->prepare("SELECT :id FROM attribute_values LIMIT 1");
        $st->bindParam(":id", $lastInsertId);
        $st->execute();
        $attribute_value_id = $st->fetchColumn();
    }


    $statement = $pdo->prepare("INSERT INTO products_table(SKU,name,price, attribute_value_id)
                    VALUES(:SKU, :name, :price, :attribute_value_id)");
    $statement->bindValue(':SKU', $SKU);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':attribute_value_id', $attribute_value_id);

        $statement->execute();
        header('location: main.php');
}


