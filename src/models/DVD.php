<?php
namespace scandi\src\models;
use scandi\src\models\abstracts\Product;
class DVD extends Product
{
    public function __construct($sku, $name, $price, $attribute_value, $id=null)
    {
        $this->id = $id;
        $this->setName($name);
        $this->setPrice($price);
        $this->setAttributeValue($attribute_value);
        $this->setMeasurement('MB');
        $this->setDescription('Size');
        $this->setSku($sku);
    }
}