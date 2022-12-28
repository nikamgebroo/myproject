<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products', 'root', '');
$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$statement = $pdo->prepare('SELECT * FROM products_table ORDER BY SKU DESC' );
$statement->execute();
$products =$statement->fetchALL(PDO::FETCH_ASSOC);

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

        <?php foreach ($products as $i=> $product) { ?>
           <form name="form1" action="" method="post">
            <div class="card">
                <div class="card-body">
                    <input type="checkbox" name="num[]" class="other" value="<?php echo $product["id"]?>" />
                    <h5><?php echo $product['SKU']?></h5>
                    <h5><?php echo $product['name'] ?></h5>
                    <h5><?php echo $product['price'] ?></h5>
                    <h5><?php echo $product['attribute_value_id'] ?></h5>
                </div>
            </div>

        <?php } ?>
        <div id="delete-product-btn">
            <input  type="submit" name="submit1" value="Mass Delete">
        </div>
    </div>
    </form>
</div>
<?php if(isset($_POST["submit1"])){
    $box=$_POST['num'];
    foreach ($box as $key => $val) {
        $statement = $pdo->prepare('DELETE FROM products_table WHERE id= :id ' );
        $statement->bindValue(':id', $val);
        $statement->execute();
        header('Location: main.php'); exit();
    }
} ?>
</body>
</html>