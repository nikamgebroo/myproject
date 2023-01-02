<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products', 'root', '');
$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare('SELECT * FROM products_table INNER JOIN attribute_values ON products_table.attribute_value_id=attribute_values.id  ORDER BY SKU DESC' );
$statement->execute();
$products =$statement->fetchALL(PDO::FETCH_ASSOC);
$value='';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div>
<div class="mainText">
<h1>Product List</h1>
    <div class ="mainProductAdd">
        <button><a href="productAdd.php">ADD</a></button>
    </div>
</div>

    <div class="checkboxes">
        <?php foreach ($products as $i=> $product){?>
        <form name="form1" method="post">
            <div class="card">
                <div class="card-body">
                    <input type="checkbox" name="num[]" class="other" value="<?php echo $product["attribute_value_id"]?>" />
                    <h5><?php echo $product['SKU']?></h5>
                    <h5><?php echo $product['name'] ?></h5>
                    <h5><?php echo $product['price'] . "$" ?></h5>
                    <h5><?php
                        if($product['type_id']==2){
                        echo $product['value'] . "MB";} ?></h5>
                </div>
            </div>
            <?php }
            ?>
            <div id="delete-product-btn">
            <input  type="submit" name="submit1" value="Mass Delete">
        </div>
    </div>
    </form>
</div>
<?php
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
</body>
</html>