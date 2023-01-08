<?php
include("Product.php");

class Book extends Product
{

    public function __construct($sku, $name, $price, $attribute_value_id, $measurement, $description)
    {
        $this->setSku($sku);
        $this->setName($name);
        $this->setPrice($price);
        $this->setAttributeValueId($attribute_value_id);
        $this->setMeasurement($measurement);
        $this->setDescription($description);
    }
}
