
<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=products', 'root', '');
$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$errors = [];
$SKU = '';
$name = '';
$price = '';
$attribute_value_id = 1;
if($_SERVER['REQUEST_METHOD'] ==='POST'){
    var_dump($_POST);
    $SKU =$_POST['SKU'];
    $name =$_POST['name'];
    $price =$_POST['price'];
    $attribute_value_id =$_POST['attribute_value_id'];

    if(!$price ){
        $errors[]='product price is required';
    }
    if(true){
        $statement = $pdo->prepare("INSERT INTO products_table(SKU,name,price,attribute_value_id)
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
            <div id="cancelProductAdd">
                <button> <a href="main.php">Cancel</a></button>
            </div>
        </div>
    </div>
</div>

<!--Product add form -->
<form id="product_form" method="post" enctype="multipart/form-data">
        <div class="inputField">
            <div class="form-group">
        <label for="SKU">SKU:</label>
        <input type="text" id="SKU" name="SKU" value="<?php echo $SKU ?>"><br><br>
            </div>
            <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name ?>"><br><br>
            </div>
            <div class="form-group">
        <label for="Price">Price ($):</label>
        <input type="number" id="price" name="price" value="<?php echo $price ?>"><br><br>
            </div>
            <div class="form-group">
                <label>attribute value id</label>
                <input type="number" id="attribute_value_id" name="attribute_value_id" value="1" >
            </div>
                <button  type="submit" name="submitAdd" value="Save">Submit</button>
        </div>

        <!-- Switcher -->
        <form class="productDescription">
            <label for="product" id="product">Type Switcher: </label>

            <select name="productType" id="productType">
                <option value="Switcher">Type Switcher</option>
                <option value="DVD">DVD</option>
                <option value="Book">Book</option>
                <option value="Furniture">Furniture</option>
            </select>
            <div class="switcherInfo">
            <div id="DVD" style="display:none;">
                <input type="number"  placeholder="#size"/>
            </div>
            <div id="Book" style="display:none;">
                <input type="number"  placeholder="#weight"/>
            </div>
            <div id="Furniture" style="display:none;">
                <input type="num"  placeholder="#height"/>
                <input type="number"  placeholder="#width"/>
                <input type="number"  placeholder="#length"/>
            </div>
            </div>
        </form>
        <div>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
            <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
            <script>
                $('#productType').on('change',function(){
                    if( $(this).val()==="DVD"){
                        $("#DVD").show()
                        $("#Book").hide();
                        $("#Furniture").hide();
                    }
                    if( $(this).val()==="Book"){
                        $("#Book").show()
                        $("#DVD").hide();
                        $("#Furniture").hide();
                    }
                    if( $(this).val()==="Furniture"){
                        $("#Furniture").show()
                        $("#Book").hide();
                        $("#DVD").hide();
                    }
                    if( $(this).val()==="Switcher"){
                        $("#Furniture").hide()
                        $("#Book").hide();
                        $("#DVD").hide();
                    }
                });
            </script>
        </div>

    </form>






</body>
</html>