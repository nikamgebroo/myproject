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
            <div class ="mainProductAdd">
                <button type=submit>Save</button>
            </div>
            <div id="cancelProductAdd">
                <button> <a href="main.php">Cancel</a></button>
            </div>
        </div>
    </div>
</div>

<!--Product add form -->
<form id="product_form">

    <form action="/#">
        <div class="inputField">
        <label for="SKU">SKU:</label>
        <input type="text" id="SKU" name="SKU"><br><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="Price">Price ($):</label>
        <input type="number" id="price" name="price"><br><br>
        </div>

        <!-- Switcher -->
        <form class="productDescription">
            <label for="product" id="product">Type Switcher: </label>

            <select name="productType" id="productType">
                <option>Type Switcher</option>
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

                    }
                    if( $(this).val()==="Book"){
                        $("#Book").show()
                    }
                    if( $(this).val()==="Furniture"){
                        $("#Furniture").show()
                    }
                });
            </script>
        </div>
    </form>

    </form>






</body>
</html>