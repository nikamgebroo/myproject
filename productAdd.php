<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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
            if ($selected == "DVD") {
                $type_id = 2;
                if (!empty($_POST['valueDVD'])) {
                    $value = $_POST['valueDVD'];
                }
            } elseif ($selected == "Book") {
                $type_id = 1;
                if (!empty($_POST['valueBook'])) {
                    $value = $_POST['valueBook'];
                }
            } elseif ($selected == "Furniture") {
                $type_id = 3;
                if (count($_POST['valueFurniture']) != 0) {
                    $dimensions = $_POST['valueFurniture'];
                    $value = $dimensions[0] . "x" . $dimensions[1] . "x" . $dimensions[2];
                }
            }
        } else {
            echo 'Please select the value.';
        }
    }
    if (!$price) {
        $errors[] = 'product price is required';
    }
    if (true) {
        $statement = $pdo->prepare("INSERT INTO attribute_values(value,type_id)
                    VALUES(:value, :type_id)");
        $statement->bindValue(':value', $value);
        $statement->bindValue(':type_id', $type_id);
        $statement->execute();
    }

    if (true) {
        $st = $pdo->prepare('SELECT max(id) FROM attribute_values LIMIT 1');
        $st->execute();
        $attribute_value_id = $st->fetchColumn();
    }

    if (true) {
        $statement = $pdo->prepare("INSERT INTO products_table(SKU,name,price, attribute_value_id)
                    VALUES(:SKU, :name, :price, :attribute_value_id)");
        $statement->bindValue(':SKU', $SKU);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':attribute_value_id', $attribute_value_id);
        $statement->execute();
        header('location: main.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add product</title>
    <link rel="stylesheet" type="text/css" href="productAddCss.css">
</head>
<body>
<div id="productAddMain">
    <div>
        <div class="productAddText">
            <h1>Product List</h1>
            <div id="ProductAddButtons">
                <button><a href="main.php">Cancel</a></button>
                <button type="submit" form="product_form" name="submitAdd" value="Save">Submit</button>
            </div>
        </div>
    </div>
</div>

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
            <input  type="number" name="valueDVD" placeholder="#size"/>
        </div>
        <div id="BookDiv" style="display:none;" class="attribute-value">
            <h5>Please, provide weight in KG:</h5>
            <label for="valueBook">Weight(KG):</label>
            <input type="number" name="valueBook" placeholder="#weight"/>
        </div>
        <div id="FurnitureDiv" style="display:none;" class="attribute-value">
            <h5>Please, provide dimensions in HxWxL format in CM: </h5>
            <label for="valueFurniture">Height(CM):</label>
            <input type="number" name="valueFurniture[]" placeholder="#height"/><br>
            <label for="valueFurniture">Width(CM) :</label>
            <input type="number" name="valueFurniture[]" placeholder="#width"/><br>
            <label for="valueFurniture">Length(CM) :</label>
            <input type="number" name="valueFurniture[]" placeholder="#length"/>

        </div>
    </div>
    <div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
        <script>
            $('#productTypeId').on('change', function () {
                let selectedId = $(this).children(":selected").attr("id");
                $('.attribute-value').hide();
                $("#" + selectedId + "Div").show();
            });
        </script>
    </div>
</form>
</body>
</html>