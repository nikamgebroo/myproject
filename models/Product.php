<?php

abstract class Product
{
    private string $sku;
    private string $name;
    private float $price;
    private string $attribute_value;
    private string $measurement;
    private string $description;

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getAttributeValue(): string
    {
        return $this->attribute_value;
    }

    /**
     * @param string $attribute_value
     */
    public function setAttributeValue(string $attribute_value): void
    {
        $this->attribute_value = $attribute_value;
    }

    /**
     * @return string
     */
    public function getMeasurement(): string
    {
        return $this->measurement;
    }

    /**
     * @param string $measurement
     */
    public function setMeasurement(string $measurement): void
    {
        $this->measurement = $measurement;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

}
