<?php

namespace controllers;

use models\Product;
use connections\Conn;

class ProductsController
{
    public static function get()
    {
        $conn = (new Conn())->conn();

        $sql = "SELECT * FROM PRODUCTS";

        $result = $conn->query($sql);

        $conn->close();
        if (isset($result) && $result->num_rows > 0 && !isset($id)) {
            $listProducts = null;
            while ($product = $result->fetch_assoc()) {
                $listProducts[] = new Product($product["id"], $product["sku"], $product["name"], $product["price"], $product["created_at"], $product["updated_at"]);
            }
            return $listProducts;
        } else {
            return null;
        }
    }
    public static function getById($id)
    {
        if (!isset($id))
            return;
        $conn = (new Conn())->conn();

        $sql = "SELECT * FROM PRODUCTS WHERE id = {$id}";

        $result = $conn->query($sql);

        $conn->close();
        if ($result->num_rows > 0) {
            $productObj = null;
            while ($product = $result->fetch_assoc()) {
                $productObj = new Product($product["id"], $product["sku"], $product["name"], $product["price"], $product["created_at"], $product["updated_at"]);
            }
            return $productObj;
        } else {
            return null;
        }
    }

    public function post(Product $product)
    {
        $conn = (new Conn())->conn();
        if (!isset($product))
            return null;
        $sql = "INSERT INTO PRODUCTS 
        (
            sku,
            name,
            price,
            created_at,
            updated_at
        )
        VALUES
        (
            '{$product->sku}',
            '{$product->name}',
            {$product->price},
            '{$product->created_at}',
            '{$product->updated_at}'
        )";
        $result = $conn->query($sql);
        var_dump($result);
        $conn->close();
        if ($result === TRUE) {
            return $result;
        } else {
            return "Erro: confira seu Json";
        }
    }
}
