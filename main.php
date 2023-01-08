<?php
require_once "dataBase.php";
require_once "views/layouts/Header.php";
require_once "repository/ProductRepository.php";
$productRepository = new ProductRepository();
?>
<style>
    <?php    require_once "public/main.css"; ?>
</style>

    <div class="checkboxes">
        <?php foreach ($productRepository->findAllProducts() as $i=> $product){?>
        <form id="form1" method="post">
            <div class="card">
                <div class="card-body">
                    <input type="checkbox" name="num[]" class="delete-checkbox" value="<?php echo $product["attribute_value_id"]?>" />
                    <h5><?php echo $product['SKU']?></h5>
                    <h5><?php echo $product['name'] ?></h5>
                    <h5><?php echo number_format($product['price'] , 2) . " $" ?></h5>
                    <h5><?php echo $product['description'] . ": " . $product['value'] . " " . $product['measurements']; ?></h5>
                </div>
            </div>
            <?php }
            ?>
    </div>
    </form>
</div>
<?php

?>
<?php require_once "views/layouts/Footer.php" ?>

