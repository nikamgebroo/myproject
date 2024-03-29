<?php
namespace scandi;
require_once __DIR__ . '/vendor/autoload.php';

use scandi\src\controllers\ProductController;

$controller = new ProductController();
?>
<?php require_once "views/layouts/productAddHeader.php" ?>
<style>
    <?php require_once "./public/productAddCss.css" ?>
</style>

<!--Product add form -->

<form id="product_form" name="add_product" method="post" action="<?php $controller->addProduct(); ?>"
      enctype="multipart/form-data">
    <?php foreach ($controller->getErrors() as $error) { ?>
        <p style="color:red"><?php echo $error ?></p>
    <?php } ?>
    <div class="form-group">
        <label for="sku">SKU:</label>
        <input type="text" id="sku" name="sku"><br><br>
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
    </div>
    <div class="form-group">
        <label for="Price">Price ($):</label>
        <input type="text" id="price" name="price"><br><br>
    </div>

    <!-- Switcher -->
    <label for="product" id="product">Type Switcher: </label>
    <select name="productType" id="productType">
        <option id="Switcher" value="">Type Switcher</option>
        <option id="DVD">DVD</option>
        <option id="Book">Book</option>
        <option id="Furniture">Furniture</option>
    </select>
    <div class="switcherInfo">
        <div id="DVDDiv" style="display:none;" class="attribute-value">
            <h5> Please, provide size in MB:</h5>
            <label for="valueDVD">Size(MB):</label>
            <input type="text" id="size" name="valueDVD" placeholder="#size"/>
        </div>
        <div id="BookDiv" style="display:none;" class="attribute-value">
            <h5>Please, provide weight in KG:</h5>
            <label for="valueBook">Weight(KG):</label>
            <input type="text" id="weight" name="valueBook" placeholder="#weight"/>
        </div>
        <div id="FurnitureDiv" style="display:none;" class="attribute-value">
            <h5>Please, provide dimensions in HxWxL format in CM: </h5>
            <label for="valueFurniture">Height(CM):</label>
            <input type="text" id="height" name="valueHeight" placeholder="#height"/><br>
            <label for="valueFurniture">Width(CM) :</label>
            <input type="text" id="width" name="valueWidth" placeholder="#width"/><br>
            <label for="valueFurniture">Length(CM) :</label>
            <input type="text" id="length" name="valueLength" placeholder="#length"/>
            <input type="hidden" class="combine" id="combine" name="valueFurniture"/>
        </div>
    </div>
    <div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script>
            $(function () {
                $('#height, #width, #length').on('input', function () {
                    $('#combine').val(
                        $('#height, #width, #length').map(function () {
                            return $(this).val();
                        }).get().join('x')
                    );
                });
            });
            $('#productType').on('change', function () {
                let selectedId = $(this).children(":selected").attr("id");
                $('.attribute-value').hide();
                $("#" + selectedId + "Div").show();
            });

            $(function () {
                let productType = $('#productType');
                $('#product_form').validate({
                    rules: {
                        sku: "required",
                        price: {
                            required: true,
                            number: true
                        },
                        name: "required",
                        productType: "required",
                        valueDVD: {
                            required: () => productType.val() === 'DVD',
                            digits: () => productType.val() === 'DVD'
                        },
                        valueBook: {
                            required: () => productType.val() === 'Book',
                            digits: () => productType.val() === 'Book'
                        },
                        valueHeight: {
                            required: () => productType.val() === 'Furniture',
                            digits: () => productType.val() === 'Furniture'
                        },
                        valueWidth: {
                            required: function () {
                                console.log(productType.val())
                                return productType.val() === 'Furniture';
                            },
                            digits: () => productType.val() === 'Furniture'
                        },
                        valueLength: {
                            required: () => productType.val() === 'Furniture',
                            digits: () => productType.val() === 'Furniture'
                        }
                    },
                    messages: {
                        sku: "Please enter SKU",
                        price: {
                            required: "Please enter price",
                            number: "Please enter numbers"
                        },
                        name: "Please enter name",
                        productType: "Please select product type",
                        valueDVD: {
                            required: "Please enter size",
                            digits: "Please enter digits"
                        },
                        valueBook: {
                            required: "Please enter weight",
                            digits: "Please enter digits"
                        },
                        valueHeight: {
                            required: "Please enter height",
                            digits: "Please enter digits"
                        },
                        valueWidth: {
                            required: "Please enter width",
                            digits: "Please enter digits"
                        },
                        valueLength: {
                            required: "Please enter length",
                            digits: "Please enter digits"
                        },
                    },
                    submitHandler: function (form) {
                        form.action();
                    }
                });
            });
        </script>
    </div>
</form>
<?php require_once "views/layouts/Footer.php" ?>

