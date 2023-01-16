<?php
//Product osztály definiálása
class Product
{
    public $id;
    public $name;
    public $description;
    public $image;
    public $price;
    public $quantity;
    public $onStock;
    public $weight;
    public $unitPrice;
    public $unitSize;
    public $flavour;
    public $colour;
    public $components;
    public $category;
    public $preFishes;
    public $discount;
    public $createdAt;
    public $deletedAt;

    public function __construct(
        $id,
        $name,
        $description,
        $image,
        $price,
        $quantity,
        $onStock,
        $weight,
        $unitPrice,
        $unitSize,
        $flavour,
        $colour,
        $components,
        $category,
        $preFishes,
        $discount,
        $createdAt,
        $deletedAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->onStock = $onStock;
        $this->weight = $weight;
        $this->unitPrice = $unitPrice;
        $this->unitSize = $unitSize;
        $this->flavour = $flavour;
        $this->colour = $colour;
        $this->components = $components;
        $this->category = $category;
        $this->preFishes = $preFishes;
        $this->discount = $discount;
        $this->preFishes = $preFishes;
        $this->createdAt = $createdAt;
        $this->deletedAt = $deletedAt;
    }
}
