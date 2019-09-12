<?php
namespace models;
class Product
{
    public $id;
    public $sku;
    public $name;
    public $price;
    public $created_at;
    public $updated_at;

    public function __construct($id, $sku, $name, $price, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

}

