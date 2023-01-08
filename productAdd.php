<?php
require_once "dataBase.php";


?>
<?php require_once "views/layouts/productAddHeader.php" ?>
<style>
    <?php require_once "public/productAddCss.css" ?>
</style>

<?php  ?>
<!--Product add form -->
<form id="product_form" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="SKU">SKU:</label>
        <input required type="text" id="SKU" name="SKU" value="<?php echo $SKU ?>"><br><br>
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input required type="text" id="name" name="name" value="<?php echo $name ?>"><br><br>
    </div>
    <div class="form-group">
        <label for="Price">Price ($):</label>
        <input required type="number" id="price" name="price" value="<?php echo $price ?>"><br><br>
    </div>

    <!-- Switcher -->
    <label for="product" id="product">Type Switcher: </label>
    <select name="productType" id="productTypeId">
        <option id="Switcher">Type Switcher</option>
        <option id="DVD">DVD</option>
        <option id="Book">Book</option>
        <option id="Furniture">Furniture</option>
    </select>
    <div class="switcherInfo">
        <div id="DVDDiv" style="display:none;" class="attribute-value">
            <h5> Please, provide size in MB:</h5>
            <label for="valueDVD">Size(MB):</label>
            <input type="number" name="valueDVD" placeholder="#size"/>
        </div>
        <div id="BookDiv" style="display:none;" class="attribute-value">
            <h5>Please, provide weight in KG:</h5>
            <label for="valueBook">Weight(KG):</label>
            <input type="number" name="valueBook" placeholder="#weight"/>
        </div>
        <div id="FurnitureDiv" style="display:none;" class="attribute-value">
            <h5>Please, provide dimensions in HxWxL format in CM: </h5>
            <label for="valueFurniture">Height(CM):</label>
            <input type="number" id="Height" placeholder="#height"/><br>
            <label for="valueFurniture">Width(CM) :</label>
            <input type="number" id="Width" placeholder="#width"/><br>
            <label for="valueFurniture">Length(CM) :</label>
            <input type="number" id="Length" placeholder="#length"/>
            <input type="hidden" class="combine" id="combine" name="valueFurniture"/>
        </div>
    </div>
    <div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
        <script>
            $(function () {
                $('#Height, #Width, #Length').on('input', function () {
                    $('#combine').val(
                        $('#Height, #Width, #Length').map(function () {
                            return $(this).val();
                        }).get().join('x')
                    );
                });
            });
            $('#productTypeId').on('change', function () {
                let selectedId = $(this).children(":selected").attr("id");
                $('.attribute-value').hide();
                $("#" + selectedId + "Div").show();
            });
        </script>
    </div>
</form>
<?php require_once "views/layouts/Footer.php" ?>

