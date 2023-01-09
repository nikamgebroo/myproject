<?php

use scandi\ProductRepository;
require_once "src/repository/ProductRepository.php";
require __DIR__ . '/vendor/autoload.php';
require_once "dataBase.php";
require_once "views/layouts/Header.php";
$productRepository = new ProductRepository();
?>
<style>
    <?php require "public/main.css"; ?>
</style>

    <div class="checkboxes">
        <?php foreach ($productRepository->findAllProducts() as $product){?>
        <form id="form1" method="post">
            <div class="card">
                <div class="card-body">
                    <input type="checkbox" name="num[]" class="delete-checkbox" value="<?php echo 1?>" />
                    <h5><?php echo $product->getSku()?></h5>
                    <h5><?php echo $product->getname()?></h5>
                    <h5><?php echo number_format($product->getPrice() , 2) . " $" ?></h5>
                    <h5><?php echo $product->getDescription() . ": " . $product->getAttributeValue() . " " . $product->getMeasurement(); ?></h5>
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

