<?php

namespace scandi\src\models;

use scandi\src\models\abstracts\Product;

class Book extends Product
{

    public function __construct($sku, $name, $price, $attribute_value, $id = null)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setPrice($price);
        $this->setAttributeValue($attribute_value);
        $this->setMeasurement('Kg');
        $this->setDescription('Weight');
        $this->setSku($sku);
    }
}
