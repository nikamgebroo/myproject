<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products', 'root', '');
$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare('SELECT * FROM products_table INNER JOIN attribute_values ON products_table.attribute_value_id=attribute_values.id INNER JOIN types_table ON attribute_values.type_id=types_table.id ORDER BY SKU DESC');
$statement->execute();
$products =$statement->fetchALL(PDO::FETCH_ASSOC);
$value='';
if(isset($_POST["submit1"])){
    $deleteProduct = $_POST['num'];
    foreach ($deleteProduct as $id) {
        $sql = "DELETE FROM attribute_values WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        header('location: main.php');
    }
}
?>
