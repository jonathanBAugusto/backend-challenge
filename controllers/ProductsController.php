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
        if (isset($result) && $result->num_rows > 0) {
            $listProducts = null;
            while ($product = $result->fetch_assoc()) {
                // $listProducts[] = new Product($product["id"], $product["partner_id"], $product["sku"], $product["name"], $product["price"], $product["created_at"], $product["updated_at"]);
                $listProducts[] = new Product($product["id"], $product["sku"], $product["name"], $product["price"], $product["created_at"], $product["updated_at"]);
            }
            return $listProducts;
        } else {
            return null;
        }
    }
    /***
     * Este método apos adicionar o produto retorna o id do mesmo na Base da Api
     */
    public function post(Product $product)
    {
        $conn = (new Conn())->conn();
        if (!isset($product))
            return null;

        // -- partner_id,
        // -- {$product->partner_id},
        $sql = "INSERT INTO PRODUCTS 
        (
            id,
            sku,
            name,
            price,
            created_at,
            updated_at
        )
        VALUES
        (
            '{$product->id}',
            '{$product->sku}',
            '{$product->name}',
            {$product->price},
            '{$product->created_at}',
            '{$product->updated_at}'
        )";
        $result = $conn->query($sql);
        // foi utilizado para retornar o id caso o mesmo fosse auto increment
        // $id = $conn->insert_id;
        $error = $conn->error;
        $conn->close();
        if ($result === TRUE) {
            return $result;
        } else {
            return "Erro: {$error}";
        }
    }
}
