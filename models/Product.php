<?php

namespace models;

class Product
{
    public $id;
    // public $partner_id;
    public $sku;
    public $name;
    public $price;
    public $created_at;
    public $updated_at;

    // public function __construct($id, $partner_id, $sku, $name, $price, $created_at = null, $updated_at = null)
    public function __construct($id, $sku, $name, $price, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        // $this->partner_id = $partner_id ?? 'NULL';
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function fromJson($json)
    {
        $jsonObj = json_decode($json, true);
        // return new Product($jsonObj['id'] ?? null, $jsonObj['partner_id'] ?? null, $jsonObj['sku'] ?? null, $jsonObj['name'] ?? null, $jsonObj['price'] ?? null, $jsonObj['created_at'] ?? null, $jsonObj['updated_at'] ?? null) ?? null;
        return new Product($jsonObj['id'] ?? null, $jsonObj['sku'] ?? null, $jsonObj['name'] ?? null, $jsonObj['price'] ?? null, $jsonObj['created_at'] ?? null, $jsonObj['updated_at'] ?? null) ?? null;
    }

    public static function validator(Product $product)
    {
        $missingFields = array();
        if (!isset($product->id))
            $missingFields[] = 'id';

        if (!isset($product->sku))
            $missingFields[] = 'sku';

        if (!isset($product->name))
            $missingFields[] = 'name';

        if (!isset($product->price))
            $missingFields[] = 'price';

        if (!isset($product->created_at))
            $missingFields[] = 'created_at';

        if (!isset($product->updated_at))
            $missingFields[] = 'updated_at';

        if (isset($missingFields))
            die("Faltam os seguintes campos para concluir a inserção em 'Product': " . PHP_EOL . PHP_EOL . implode(PHP_EOL, $missingFields));
        else
            true;
    }
}
