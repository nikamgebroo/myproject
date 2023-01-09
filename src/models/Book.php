<?php
namespace scandi\src\models;
use scandi\src\models\abstracts\Product;

class Book extends Product
{

    public function __construct($sku, $name, $price, $attribute_value, $measurement, $description)
    {
        $this->setName($name);
        $this->setPrice($price);
        $this->setAttributeValue($attribute_value);
        $this->setMeasurement($measurement);
        $this->setDescription($description);
        $this->setSku($sku);
    }
}
