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
    <div id="delete-product-btn">
        <form method="post" action="delete.php">
        <button id="delete_button">Mass delete</button>
        </form>
    </div>

</div>
    <div class="checkboxes">
        <?php foreach ($products as $i=> $product) { ?>
           <form action="" method="post">
            <div class="card">
                <input type="checkbox" class="delete-checkbox" />
                <div class="card-body">
                    <h5><?php echo $product['SKU']?></h5>
                    <h5><?php echo $product['name'] ?></h5>
                    <h5><?php echo $product['price'] ?></h5>
                    <h5><?php echo $product['attribute_value_id'] ?></h5>
                </div>
            </div>
           </form>
        <?php } ?>

    </div>
</div>

</body>
</html>