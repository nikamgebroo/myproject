<?php



abstract class allProducts
{   public $errors = [];
    public ?int $id = null;
    public string $sku;
    public string $name;
    public float $price;
    public int $attribute_value_id;
}
