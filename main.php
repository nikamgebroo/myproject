<?php

namespace scandi;
require_once __DIR__ . '/vendor/autoload.php';

use scandi\src\repository\ProductRepository;

require_once "views/layouts/Header.php";

$productRepository = new ProductRepository();
if (isset($_POST["submit1"])) {
    $productIds = $_POST['num'];
    $productRepository->deleteProducts($productIds);
    header('location: main.php');
}
?>
<style>
    <?php require "public/main.css"; ?>
</style>

<div class="checkboxes">
    <?php foreach ($productRepository->findAllProducts() as $product){ ?>
    <form id="form1" method="post">
        <div class="card">
            <div class="card-body">
                <input type="checkbox" name="num[]" class="delete-checkbox" value="<?php echo $product->getId() ?>"/>
                <h5><?php echo $product->getSku() ?></h5>
                <h5><?php echo $product->getname() ?></h5>
                <h5><?php echo number_format($product->getPrice(), 2) . " $" ?></h5>
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

